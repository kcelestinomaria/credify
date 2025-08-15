<?php

namespace App\Http\Controllers\InstitutionalAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class StudentController extends Controller
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
        $students = User::where('institution_id', $user->institution_id)
            ->where('role', 'student')
            ->with('institution')
            ->latest()
            ->paginate(10);

        return view('institutional-admin.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('institutional-admin.students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'school_id' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users')->where(function ($query) use ($user) {
                    return $query->where('institution_id', $user->institution_id);
                })
            ],
            'email' => 'required|email|unique:users,email',
        ]);

        // Generate temporary password
        $temporaryPassword = Str::random(8);

        $student = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'school_id' => $request->school_id,
            'email' => $request->email,
            'password' => Hash::make($temporaryPassword),
            'temporary_password' => $temporaryPassword,
            'role' => 'student',
            'institution_id' => $user->institution_id,
            'must_change_password' => true,
        ]);

        return redirect()->route('institutional-admin.students.show', $student)
            ->with('success', 'Student created successfully!')
            ->with('temporary_password', $temporaryPassword);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $student)
    {
        $this->authorizeStudent($student);
        
        $credentials = $student->credentials()
            ->with(['institution', 'issuedBy'])
            ->latest()
            ->get();

        return view('institutional-admin.students.show', compact('student', 'credentials'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $student)
    {
        $this->authorizeStudent($student);
        
        return view('institutional-admin.students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $student)
    {
        $this->authorizeStudent($student);
        
        $user = Auth::user();
        
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'school_id' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users')->where(function ($query) use ($user) {
                    return $query->where('institution_id', $user->institution_id);
                })->ignore($student->id)
            ],
            'email' => 'required|email|unique:users,email,' . $student->id,
        ]);

        $student->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'school_id' => $request->school_id,
            'email' => $request->email,
        ]);

        return redirect()->route('institutional-admin.students.show', $student)
            ->with('success', 'Student updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $student)
    {
        $this->authorizeStudent($student);
        
        $student->delete();

        return redirect()->route('institutional-admin.students.index')
            ->with('success', 'Student deleted successfully!');
    }

    /**
     * Reset student password.
     */
    public function resetPassword(User $student)
    {
        $this->authorizeStudent($student);
        
        $temporaryPassword = Str::random(8);
        
        $student->update([
            'password' => Hash::make($temporaryPassword),
            'temporary_password' => $temporaryPassword,
            'must_change_password' => true,
        ]);

        return redirect()->route('institutional-admin.students.show', $student)
            ->with('success', 'Password reset successfully!')
            ->with('temporary_password', $temporaryPassword);
    }

    /**
     * Ensure the student belongs to the current institutional admin's institution.
     */
    private function authorizeStudent(User $student)
    {
        $user = Auth::user();
        
        if ($student->institution_id !== $user->institution_id || $student->role !== 'student') {
            abort(403, 'Unauthorized access to student.');
        }
    }
}
