<?php

namespace App\Http\Controllers;

use App\Models\Institution;
use App\Models\User;
use App\Models\Credential;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperAdminDashboardController extends Controller
{
    /**
     * Show the Super Admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get counts for dashboard cards
        $institutionsCount = Institution::count();
        $institutionalAdminsCount = User::where('role', 'institution_admin')->count();
        $credentialsCount = Credential::count();

        return view('super-admin.dashboard', [
            'institutionsCount' => $institutionsCount,
            'institutionalAdminsCount' => $institutionalAdminsCount,
            'credentialsCount' => $credentialsCount,
        ]);
    }

    /**
     * Get recent activities for the dashboard.
     * This is a placeholder - in a real application, you might use an activity log package.
     *
     * @return array
     */
    protected function getRecentActivities()
    {
        // This is a placeholder - you should replace this with actual activity logging
        return [
            [
                'action' => 'New institution created',
                'time' => '2 hours ago',
                'details' => 'University of Example was added to the system',
            ],
            [
                'action' => 'User signed up',
                'time' => '1 day ago',
                'details' => 'John Doe registered as an institution admin',
            ],
            [
                'action' => 'Credential issued',
                'time' => '2 days ago',
                'details' => 'Bachelor of Science in Computer Science was issued to Jane Smith',
            ],
        ];
    }
}
