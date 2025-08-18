<?php

namespace App\Http\Controllers;

use App\Models\Credential;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CredentialController extends Controller
{
    /**
     * Get credential details for modal display
     */
    public function getDetails($id): JsonResponse
    {
        $credential = Credential::with(['student', 'institution', 'issuedBy'])
            ->where('id', $id)
            ->where('user_id', auth()->id()) // Ensure student can only access their own credentials
            ->first();

        if (!$credential) {
            return response()->json(['error' => 'Credential not found'], 404);
        }

        return response()->json([
            'credential_name' => $credential->credential_name,
            'type' => $credential->type,
            'issue_date' => $credential->created_at->format('M d, Y'),
            'institution' => $credential->institution->name,
            'verification_code' => $credential->verification_code,
            'credential_hash' => $credential->credential_hash,
            'student_name' => $credential->student_first_name . ' ' . $credential->student_last_name,
            'student_id' => $credential->student_school_id,
        ]);
    }

    /**
     * Public verification endpoint for shared credentials
     */
    public function verify($id)
    {
        $credential = Credential::with(['student', 'institution', 'issuedBy'])
            ->where('id', $id)
            ->first();

        if (!$credential) {
            abort(404, 'Credential not found');
        }

        return view('credential.verify', compact('credential'));
    }

    /**
     * Public API endpoint for credential verification
     */
    public function verifyApi($id): JsonResponse
    {
        $credential = Credential::with(['student', 'institution', 'issuedBy'])
            ->where('id', $id)
            ->first();

        if (!$credential) {
            return response()->json(['error' => 'Credential not found'], 404);
        }

        return response()->json([
            'verified' => true,
            'credential' => [
                'name' => $credential->credential_name,
                'type' => $credential->type,
                'issue_date' => $credential->created_at->format('M d, Y'),
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
                ]
            ]
        ]);
    }
}
