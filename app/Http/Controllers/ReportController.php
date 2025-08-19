<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Credential;
use App\Models\Institution;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Generate system audit report for super admin
     */
    public function systemAuditReport()
    {
        // Ensure only super admin can access
        if (!auth()->user()->isSuperAdmin()) {
            abort(403, 'Unauthorized access');
        }

        // Gather comprehensive system data
        $data = $this->gatherSystemData();

        $pdf = Pdf::loadView('reports.system-audit', $data);
        $pdf->setPaper('A4', 'portrait');
        
        $filename = 'system-audit-report-' . now()->format('Y-m-d-H-i-s') . '.pdf';
        
        return $pdf->download($filename);
    }

    /**
     * Generate users report for super admin
     */
    public function usersReport()
    {
        // Ensure only super admin can access
        if (!auth()->user()->isSuperAdmin()) {
            abort(403, 'Unauthorized access');
        }

        $users = User::with('institution')
            ->orderBy('created_at', 'desc')
            ->get();

        $data = [
            'users' => $users,
            'total_users' => $users->count(),
            'users_by_role' => $users->groupBy('role')->map->count(),
            'recent_users' => $users->where('created_at', '>=', now()->subDays(30))->count(),
            'generated_at' => now(),
            'generated_by' => auth()->user()->first_name . ' ' . auth()->user()->last_name
        ];

        $pdf = Pdf::loadView('reports.users-report', $data);
        $pdf->setPaper('A4', 'portrait');
        
        $filename = 'users-report-' . now()->format('Y-m-d-H-i-s') . '.pdf';
        
        return $pdf->download($filename);
    }

    /**
     * Generate credentials report for super admin
     */
    public function credentialsReport()
    {
        // Ensure only super admin can access
        if (!auth()->user()->isSuperAdmin()) {
            abort(403, 'Unauthorized access');
        }

        $credentials = Credential::with(['student', 'institution', 'issuedBy'])
            ->orderBy('issued_at', 'desc')
            ->get();

        $data = [
            'credentials' => $credentials,
            'total_credentials' => $credentials->count(),
            'credentials_by_type' => $credentials->groupBy('type')->map->count(),
            'credentials_by_institution' => $credentials->groupBy('institution.name')->map->count(),
            'recent_credentials' => $credentials->where('issued_at', '>=', now()->subDays(30))->count(),
            'generated_at' => now(),
            'generated_by' => auth()->user()->first_name . ' ' . auth()->user()->last_name
        ];

        $pdf = Pdf::loadView('reports.credentials-report', $data);
        $pdf->setPaper('A4', 'landscape');
        
        $filename = 'credentials-report-' . now()->format('Y-m-d-H-i-s') . '.pdf';
        
        return $pdf->download($filename);
    }

    /**
     * Gather comprehensive system data for audit report
     */
    private function gatherSystemData()
    {
        $users = User::with('institution')->get();
        $credentials = Credential::with(['student', 'institution', 'issuedBy'])->get();
        $institutions = Institution::withCount(['users', 'credentials'])->get();

        return [
            // System overview
            'total_users' => $users->count(),
            'total_credentials' => $credentials->count(),
            'total_institutions' => $institutions->count(),
            
            // User statistics
            'users_by_role' => $users->groupBy('role')->map->count(),
            'recent_users' => $users->where('created_at', '>=', now()->subDays(30))->count(),
            'active_users' => $users->where('updated_at', '>=', now()->subDays(7))->count(),
            
            // Credential statistics
            'credentials_by_type' => $credentials->groupBy('type')->map->count(),
            'recent_credentials' => $credentials->where('issued_at', '>=', now()->subDays(30))->count(),
            'credentials_this_month' => $credentials->where('issued_at', '>=', now()->startOfMonth())->count(),
            'credentials_last_month' => $credentials->whereBetween('issued_at', [
                now()->subMonth()->startOfMonth(),
                now()->subMonth()->endOfMonth()
            ])->count(),
            
            // Institution statistics
            'institutions_with_users' => $institutions->where('users_count', '>', 0)->count(),
            'institutions_with_credentials' => $institutions->where('credentials_count', '>', 0)->count(),
            'avg_users_per_institution' => round($institutions->avg('users_count') ?? 0, 1),
            'avg_credentials_per_institution' => round($institutions->avg('credentials_count') ?? 0, 1),
            
            // System activity
            'daily_credential_issuance' => $credentials->groupBy(function($credential) {
                return $credential->issued_at->format('Y-m-d');
            })->map->count()->sortKeys()->take(30),
            
            'monthly_user_registration' => $users->groupBy(function($user) {
                return $user->created_at->format('Y-m');
            })->map->count()->sortKeys()->take(12),
            
            // Top performing institutions
            'top_institutions_by_credentials' => $institutions->sortByDesc('credentials_count')->take(10),
            'top_institutions_by_users' => $institutions->sortByDesc('users_count')->take(10),
            
            // Recent activity
            'recent_credentials_list' => $credentials->sortByDesc('issued_at')->take(20),
            'recent_users_list' => $users->sortByDesc('created_at')->take(20),
            
            // Report metadata
            'generated_at' => now(),
            'generated_by' => auth()->user()->first_name . ' ' . auth()->user()->last_name,
            'report_period' => [
                'from' => now()->subYear()->format('Y-m-d'),
                'to' => now()->format('Y-m-d')
            ]
        ];
    }
}
