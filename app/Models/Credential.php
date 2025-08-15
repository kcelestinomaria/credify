<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Credential extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'institution_id',
        'issued_by',
        'type',
        'credential_name',
        'student_first_name',
        'student_last_name',
        'student_school_id',
        'verification_code',
        'file_path',
        'credential_hash',
        'issued_at'
    ];

    protected $casts = [
        'issued_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($credential) {
            if (empty($credential->verification_code)) {
                $credential->verification_code = 'CRED-' . strtoupper(Str::random(8));
            }
            
            // Generate credential hash and set issued_at timestamp
            $credential->credential_hash = $credential->generateCredentialHash();
            $credential->issued_at = now();
        });
    }

    /**
     * Get the student that owns the credential.
     */
    public function student()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the institution that issued the credential.
     */
    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    /**
     * Get the institutional admin who issued the credential.
     */
    public function issuedBy()
    {
        return $this->belongsTo(User::class, 'issued_by');
    }

    /**
     * Generate a cryptographic hash for the credential
     */
    public function generateCredentialHash()
    {
        $data = [
            'credential_name' => $this->credential_name,
            'type' => $this->type,
            'student_first_name' => $this->student_first_name,
            'student_last_name' => $this->student_last_name,
            'student_school_id' => $this->student_school_id,
            'verification_code' => $this->verification_code,
            'institution_id' => $this->institution_id,
            'issued_by' => $this->issued_by,
            'timestamp' => now()->toISOString()
        ];
        
        return hash('sha256', json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
    }

    /**
     * Generate W3C Verifiable Credential JSON-LD format compliant with W3C VC Data Model 2.0
     */
    public function toW3CCredential()
    {
        // Ensure proper date formatting for W3C compliance using Carbon methods
        $issuanceDate = $this->issued_at 
            ? $this->issued_at->toISOString() 
            : $this->created_at->toISOString();
            
        $proofDate = $this->issued_at 
            ? $this->issued_at->toISOString() 
            : $this->created_at->toISOString();
            
        return [
            '@context' => [
                'https://www.w3.org/ns/credentials/v2',
                'https://www.w3.org/ns/credentials/examples/v2'
            ],
            'id' => url("/verify/{$this->id}"),
            'type' => ['VerifiableCredential', 'EducationalCredential'],
            'issuer' => [
                'id' => url("/institutions/{$this->institution_id}"),
                'name' => $this->institution->name ?? 'Unknown Institution'
            ],
            'validFrom' => $issuanceDate,
            'credentialSubject' => [
                'id' => "did:student:{$this->student_school_id}",
                'name' => "{$this->student_first_name} {$this->student_last_name}",
                'studentId' => $this->student_school_id,
                'hasCredential' => [
                    'type' => $this->type,
                    'name' => $this->credential_name,
                    'verificationCode' => $this->verification_code
                ]
            ],
            'credentialStatus' => [
                'id' => url("/credential/{$this->id}/status"),
                'type' => 'StatusList2021Entry'
            ],
            'credentialSchema' => [
                'id' => url("/schemas/educational-credential"),
                'type' => 'JsonSchema'
            ],
            'proof' => [
                'type' => 'DataIntegrityProof',
                'created' => $proofDate,
                'verificationMethod' => url("/institutions/{$this->institution_id}/keys/1"),
                'proofPurpose' => 'assertionMethod',
                'proofValue' => $this->credential_hash
            ]
        ];
    }

    /**
     * Get the available credential types.
     */
    public static function getTypes()
    {
        return [
            'Degree' => 'Degree',
            'Certificate' => 'Certificate',
            'Diploma' => 'Diploma'
        ];
    }
}
