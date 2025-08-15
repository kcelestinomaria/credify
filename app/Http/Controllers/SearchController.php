<?php

namespace App\Http\Controllers;

use App\Models\Credential;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SearchController extends Controller
{
    /**
     * Show the public credential search page
     */
    public function index()
    {
        return view('search.index');
    }

    /**
     * Search for a credential by verification code
     */
    public function search(Request $request): JsonResponse
    {
        $request->validate([
            'verification_code' => 'required|string|min:3|max:50'
        ]);

        $verificationCode = trim($request->verification_code);

        // Search for credential by verification code
        $credential = Credential::with(['student', 'institution', 'issuedBy'])
            ->where('verification_code', $verificationCode)
            ->first();

        if (!$credential) {
            return response()->json([
                'found' => false,
                'message' => 'No credential found with this verification code.'
            ]);
        }

        return response()->json([
            'found' => true,
            'credential' => [
                'id' => $credential->id,
                'credential_name' => $credential->credential_name,
                'type' => $credential->type,
                'issue_date' => $credential->created_at->format('F d, Y'),
                'verification_code' => $credential->verification_code,
                'student' => [
                    'name' => $credential->student_first_name . ' ' . $credential->student_last_name,
                    'student_id' => $credential->student_school_id,
                ],
                'institution' => [
                    'name' => $credential->institution->name,
                ],
                'issued_by' => [
                    'name' => $credential->issuedBy->first_name . ' ' . $credential->issuedBy->last_name,
                ],
                'verify_url' => route('credential.verify', $credential->id)
            ]
        ]);
    }
}
