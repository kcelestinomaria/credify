<?php

namespace App\Http\Controllers;

use App\Models\Credential;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CredentialDownloadController extends Controller
{
    /**
     * Download W3C Verifiable Credential JSON-LD for authenticated users
     */
    public function downloadForUser($id)
    {
        $credential = Credential::with(['student', 'institution', 'issuedBy'])
            ->where('id', $id)
            ->where('user_id', auth()->id()) // Ensure student can only download their own credentials
            ->first();

        if (!$credential) {
            abort(404, 'Credential not found');
        }

        return $this->generateDownloadResponse($credential);
    }

    /**
     * Download W3C Verifiable Credential JSON-LD for institutional admins
     */
    public function downloadForAdmin($id)
    {
        $user = auth()->user();
        
        if (!$user->isInstitutionalAdmin()) {
            abort(403, 'Unauthorized');
        }

        $credential = Credential::with(['student', 'institution', 'issuedBy'])
            ->where('id', $id)
            ->where('institution_id', $user->institution_id) // Admin can only download from their institution
            ->first();

        if (!$credential) {
            abort(404, 'Credential not found');
        }

        return $this->generateDownloadResponse($credential);
    }

    /**
     * Download W3C Verifiable Credential JSON-LD for institutional admins (alias method)
     */
    public function downloadForInstitutionalAdmin($id)
    {
        return $this->downloadForAdmin($id);
    }

    /**
     * Download W3C Verifiable Credential JSON-LD for public verification
     */
    public function downloadPublic($id)
    {
        $credential = Credential::with(['student', 'institution', 'issuedBy'])
            ->where('id', $id)
            ->first();

        if (!$credential) {
            abort(404, 'Credential not found');
        }

        return $this->generateDownloadResponse($credential);
    }

    /**
     * Get credential hash for API access
     */
    public function getHash($id): JsonResponse
    {
        $credential = Credential::where('id', $id)->first();

        if (!$credential) {
            return response()->json(['error' => 'Credential not found'], 404);
        }

        // For public hash access, only return the hash
        return response()->json([
            'credential_id' => $credential->id,
            'verification_code' => $credential->verification_code,
            'credential_hash' => $credential->credential_hash,
            'issued_at' => $credential->issued_at ? $credential->issued_at->toISOString() : $credential->created_at->toISOString()
        ]);
    }

    /**
     * Generate download response for W3C credential
     */
    private function generateDownloadResponse(Credential $credential)
    {
        $w3cCredential = $credential->toW3CCredential();
        $filename = "credential-{$credential->verification_code}.json";
        
        return response()
            ->json($w3cCredential, 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
            ->header('Content-Type', 'application/ld+json')
            ->header('Content-Disposition', "attachment; filename=\"{$filename}\"");
    }
}
