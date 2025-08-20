<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Institution;
use App\Models\User;
use App\Http\Requests\StoreInstitutionalAdminRequest;
use App\Http\Requests\UpdateInstitutionalAdminRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class InstitutionalAdminController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:super_admin');
    }

    /**
     * Display a listing of institutional admins.
     */
    public function index(): View
    {
        $institutionalAdmins = User::with('institution')
            ->where('role', 'institutional_admin')
            ->latest()
            ->paginate(10);
            
        return view('super-admin.institutional-admins.index', compact('institutionalAdmins'));
    }

    /**
     * Show the form for creating a new institutional admin.
     */
    public function create(): View
    {
        $institutions = Institution::orderBy('name')->get();
        return view('super-admin.institutional-admins.create', compact('institutions'));
    }

    /**
     * Store a newly created institutional admin in storage.
     */
    public function store(StoreInstitutionalAdminRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        
        // Generate a temporary password that must be changed on first login
        $temporaryPassword = Str::random(12);
        
        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'password' => Hash::make($temporaryPassword),
            'role' => 'institutional_admin',
            'institution_id' => $validated['institution_id'],
            'must_change_password' => true, // We'll add this field to the migration
        ]);
        
        // Store the temporary password in session to show to super admin
        session()->flash('temporary_password', $temporaryPassword);
        session()->flash('new_admin_email', $user->email);
        
        return redirect()->route('institutional-admins.index')
            ->with('success', 'Institutional admin created successfully. Please provide the temporary password to the admin.');
    }

    /**
     * Display the specified institutional admin.
     */
    public function show(User $institutionalAdmin): View
    {
        // Ensure the user is an institutional admin
        if ($institutionalAdmin->role !== 'institutional_admin') {
            abort(404);
        }
        
        $institutionalAdmin->load('institution');
        return view('super-admin.institutional-admins.show', compact('institutionalAdmin'));
    }

    /**
     * Show the form for editing the specified institutional admin.
     */
    public function edit(User $institutionalAdmin): View
    {
        // Ensure the user is an institutional admin
        if ($institutionalAdmin->role !== 'institutional_admin') {
            abort(404);
        }
        
        $institutions = Institution::orderBy('name')->get();
        return view('super-admin.institutional-admins.edit', compact('institutionalAdmin', 'institutions'));
    }

    /**
     * Update the specified institutional admin in storage.
     */
    public function update(UpdateInstitutionalAdminRequest $request, User $institutionalAdmin): RedirectResponse
    {
        // Ensure the user is an institutional admin
        if ($institutionalAdmin->role !== 'institutional_admin') {
            abort(404);
        }
        
        $validated = $request->validated();
        
        $institutionalAdmin->update([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'institution_id' => $validated['institution_id'],
        ]);
        
        return redirect()->route('institutional-admins.index')
            ->with('success', 'Institutional admin updated successfully.');
    }

    /**
     * Remove the specified institutional admin from storage.
     */
    public function destroy(User $institutionalAdmin): RedirectResponse
    {
        // Ensure the user is an institutional admin
        if ($institutionalAdmin->role !== 'institutional_admin') {
            abort(404);
        }
        
        $institutionalAdmin->delete();
        
        return redirect()->route('institutional-admins.index')
            ->with('success', 'Institutional admin deleted successfully.');
    }

    /**
     * Reset password for the specified institutional admin.
     */
    public function resetPassword(User $institutionalAdmin): RedirectResponse
    {
        // Ensure the user is an institutional admin
        if ($institutionalAdmin->role !== 'institutional_admin') {
            abort(404);
        }
        
        // Generate a new temporary password
        $temporaryPassword = Str::random(12);
        
        $institutionalAdmin->update([
            'password' => Hash::make($temporaryPassword),
            'must_change_password' => true,
        ]);
        
        // Store the temporary password in session to show to super admin
        session()->flash('temporary_password', $temporaryPassword);
        session()->flash('reset_admin_email', $institutionalAdmin->email);
        
        return redirect()->route('institutional-admins.index')
            ->with('success', 'Password reset successfully. Please provide the new temporary password to the admin.');
    }
}
