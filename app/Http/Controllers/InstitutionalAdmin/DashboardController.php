<?php

namespace App\Http\Controllers\InstitutionalAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Credential;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:institutional_admin']);
    }

    public function index()
    {
        $user = Auth::user();
        $institutionId = $user->institution_id;

        // Get statistics for the institutional admin's institution
        $studentsCount = User::where('institution_id', $institutionId)
            ->where('role', 'student')
            ->count();

        $credentialsCount = Credential::where('institution_id', $institutionId)
            ->count();

        $recentStudents = User::where('institution_id', $institutionId)
            ->where('role', 'student')
            ->latest()
            ->take(5)
            ->get();

        $recentCredentials = Credential::where('institution_id', $institutionId)
            ->with(['student', 'issuedBy'])
            ->latest()
            ->take(5)
            ->get();

        return view('institutional-admin.dashboard', compact(
            'studentsCount',
            'credentialsCount',
            'recentStudents',
            'recentCredentials'
        ));
    }
}
