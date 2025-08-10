<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordChangeController extends Controller
{
    /**
     * Show the password change form.
     */
    public function showChangeForm()
    {
        return view('auth.change-password');
    }

    /**
     * Handle the password change request.
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = auth()->user();

        // Update the password
        $user->update([
            'password' => Hash::make($request->password),
            'must_change_password' => false,
        ]);

        // Redirect based on user role
        $redirectRoute = match ($user->role) {
            'super_admin' => 'super-admin.dashboard',
            'institution_admin' => 'institution-admin.dashboard',
            'student' => 'student.dashboard',
            default => 'dashboard',
        };

        return redirect()->route($redirectRoute)
            ->with('success', 'Your password has been successfully changed.');
    }
}
