<?php

namespace App\Http\Controllers;

use App\Models\Credential;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class CredentialPdfController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Download credential as PDF
     */
    public function downloadCredential($id)
    {
        $credential = Credential::with(['student', 'institution', 'issuedBy'])->findOrFail($id);
        
        // Authorization check
        $this->authorizeCredentialAccess($credential);

        $data = [
            'credential' => $credential,
            'w3c_credential' => $credential->toW3CCredential(),
            'generated_at' => now(),
            'verification_url' => url("/verify/{$credential->id}")
        ];

        $pdf = Pdf::loadView('pdfs.credential', $data);
        $pdf->setPaper('A4', 'portrait');
        
        $filename = 'credential-' . $credential->verification_code . '.pdf';
        
        return $pdf->download($filename);
    }

    /**
     * Download multiple credentials as a single PDF (for institutional admins)
     */
    public function downloadMultipleCredentials(Request $request)
    {
        $request->validate([
            'credential_ids' => 'required|array',
            'credential_ids.*' => 'exists:credentials,id'
        ]);

        $credentials = Credential::with(['student', 'institution', 'issuedBy'])
            ->whereIn('id', $request->credential_ids)
            ->get();

        // Authorize access to all credentials
        foreach ($credentials as $credential) {
            $this->authorizeCredentialAccess($credential);
        }

        $data = [
            'credentials' => $credentials,
            'generated_at' => now(),
            'generated_by' => auth()->user()->first_name . ' ' . auth()->user()->last_name,
            'total_credentials' => $credentials->count()
        ];

        $pdf = Pdf::loadView('pdfs.multiple-credentials', $data);
        $pdf->setPaper('A4', 'portrait');
        
        $filename = 'credentials-batch-' . now()->format('Y-m-d-H-i-s') . '.pdf';
        
        return $pdf->download($filename);
    }

    /**
     * Download student's credentials portfolio
     */
    public function downloadStudentPortfolio($userId = null)
    {
        $user = $userId ? \App\Models\User::findOrFail($userId) : auth()->user();
        
        // Authorization check
        if (!auth()->user()->isSuperAdmin() && 
            !auth()->user()->isInstitutionalAdmin() && 
            auth()->id() !== $user->id) {
            abort(403, 'Unauthorized access');
        }

        $credentials = Credential::with(['institution', 'issuedBy'])
            ->where('user_id', $user->id)
            ->orderBy('issued_at', 'desc')
            ->get();

        if ($credentials->isEmpty()) {
            return back()->with('error', 'No credentials found for this student.');
        }

        $data = [
            'student' => $user,
            'credentials' => $credentials,
            'generated_at' => now(),
            'total_credentials' => $credentials->count(),
            'credentials_by_type' => $credentials->groupBy('type')->map->count()
        ];

        $pdf = Pdf::loadView('pdfs.student-portfolio', $data);
        $pdf->setPaper('A4', 'portrait');
        
        $filename = 'portfolio-' . $user->school_id . '-' . now()->format('Y-m-d') . '.pdf';
        
        return $pdf->download($filename);
    }

    /**
     * Authorize credential access based on user role
     */
    private function authorizeCredentialAccess(Credential $credential)
    {
        $user = auth()->user();

        if ($user->isSuperAdmin()) {
            return; // Super admin can access all credentials
        }

        if ($user->isInstitutionalAdmin()) {
            // Institutional admin can access credentials from their institution
            if ($credential->institution_id !== $user->institution_id) {
                abort(403, 'Unauthorized access to this credential');
            }
            return;
        }

        if ($user->isStudent()) {
            // Students can only access their own credentials
            if ($credential->user_id !== $user->id) {
                abort(403, 'Unauthorized access to this credential');
            }
            return;
        }

        abort(403, 'Unauthorized access');
    }
}
