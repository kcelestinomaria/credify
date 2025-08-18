<?php

namespace App\Http\Controllers\InstitutionalAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:institutional_admin']);
    }

    /**
     * Show the profile page.
     */
    public function show()
    {
        $user = Auth::user();
        $user->load('institution');
        
        return view('institutional-admin.profile.show', compact('user'));
    }

    /**
     * Show the password change form.
     */
    public function editPassword()
    {
        return view('institutional-admin.profile.change-password');
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = Auth::user();
        
        $user->update([
            'password' => Hash::make($request->password),
            'must_change_password' => false, // Remove the requirement to change password
        ]);

        return redirect()->route('institutional-admin.profile.show')
            ->with('success', 'Password updated successfully!');
    }

    /**
     * Show the profile edit form.
     */
    public function edit()
    {
        $user = Auth::user();
        
        return view('institutional-admin.profile.edit', compact('user'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
        ]);

        return redirect()->route('institutional-admin.profile.show')
            ->with('success', 'Profile updated successfully!');
    }
}
