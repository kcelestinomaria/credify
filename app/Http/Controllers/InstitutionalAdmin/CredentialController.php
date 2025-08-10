<?php

namespace App\Http\Controllers\InstitutionalAdmin;

use App\Http\Controllers\Controller;
use App\Models\Credential;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CredentialController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:institutional_admin']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $credentials = Credential::where('institution_id', $user->institution_id)
            ->with(['student', 'institution', 'issuedBy'])
            ->latest()
            ->paginate(10);

        return view('institutional-admin.credentials.index', compact('credentials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $user = Auth::user();
        $students = User::where('institution_id', $user->institution_id)
            ->where('role', 'student')
            ->orderBy('first_name')
            ->get();

        $selectedStudent = null;
        if ($request->has('student_id')) {
            $selectedStudent = User::where('id', $request->student_id)
                ->where('institution_id', $user->institution_id)
                ->where('role', 'student')
                ->first();
        }

        return view('institutional-admin.credentials.create', compact('students', 'selectedStudent'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'type' => 'required|in:Degree,Certificate,Diploma',
            'credential_name' => 'required|string|max:255',
            'student_first_name' => 'required|string|max:255',
            'student_last_name' => 'required|string|max:255',
            'student_school_id' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,docx|max:10240', // 10MB max
        ]);

        // Verify student belongs to the same institution
        $student = User::where('id', $request->user_id)
            ->where('institution_id', $user->institution_id)
            ->where('role', 'student')
            ->firstOrFail();

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('credentials', 'public');
        }

        $credential = Credential::create([
            'user_id' => $student->id,
            'institution_id' => $user->institution_id,
            'issued_by' => $user->id,
            'type' => $request->type,
            'credential_name' => $request->credential_name,
            'student_first_name' => $student->first_name,
            'student_last_name' => $student->last_name,
            'student_school_id' => $student->school_id,
            'file_path' => $filePath,
        ]);

        return redirect()->route('institutional-admin.credentials.show', $credential)
            ->with('success', 'Credential created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Credential $credential)
    {
        $this->authorizeCredential($credential);
        
        $credential->load(['student', 'institution', 'issuedBy']);

        return view('institutional-admin.credentials.show', compact('credential'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Credential $credential)
    {
        $this->authorizeCredential($credential);
        
        $user = Auth::user();
        $students = User::where('institution_id', $user->institution_id)
            ->where('role', 'student')
            ->orderBy('first_name')
            ->get();

        return view('institutional-admin.credentials.edit', compact('credential', 'students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Credential $credential)
    {
        $this->authorizeCredential($credential);
        
        $user = Auth::user();
        
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'type' => 'required|in:Degree,Certificate,Diploma',
            'credential_name' => 'required|string|max:255',
            'student_first_name' => 'required|string|max:255',
            'student_last_name' => 'required|string|max:255',
            'student_school_id' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,docx|max:10240',
        ]);

        // Verify student belongs to the same institution
        $student = User::where('id', $request->user_id)
            ->where('institution_id', $user->institution_id)
            ->where('role', 'student')
            ->firstOrFail();

        $filePath = $credential->file_path;
        if ($request->hasFile('file')) {
            // Delete old file if exists
            if ($filePath) {
                Storage::disk('public')->delete($filePath);
            }
            $filePath = $request->file('file')->store('credentials', 'public');
        }

        $credential->update([
            'user_id' => $student->id,
            'type' => $request->type,
            'credential_name' => $request->credential_name,
            'student_first_name' => $student->first_name,
            'student_last_name' => $student->last_name,
            'student_school_id' => $student->school_id,
            'file_path' => $filePath,
        ]);

        return redirect()->route('institutional-admin.credentials.show', $credential)
            ->with('success', 'Credential updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Credential $credential)
    {
        $this->authorizeCredential($credential);
        
        // Delete associated file if exists
        if ($credential->file_path) {
            Storage::disk('public')->delete($credential->file_path);
        }
        
        $credential->delete();

        return redirect()->route('institutional-admin.credentials.index')
            ->with('success', 'Credential deleted successfully!');
    }

    /**
     * Download the credential file.
     */
    public function download(Credential $credential)
    {
        $this->authorizeCredential($credential);
        
        if (!$credential->file_path || !Storage::disk('public')->exists($credential->file_path)) {
            abort(404, 'File not found.');
        }

        return Storage::disk('public')->download($credential->file_path);
    }

    /**
     * Ensure the credential belongs to the current institutional admin's institution.
     */
    private function authorizeCredential(Credential $credential)
    {
        $user = Auth::user();
        
        if ($credential->institution_id !== $user->institution_id) {
            abort(403, 'Unauthorized access to credential.');
        }
    }
}
