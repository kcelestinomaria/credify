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
        'file_path'
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($credential) {
            if (empty($credential->verification_code)) {
                $credential->verification_code = 'CRED-' . strtoupper(Str::random(8));
            }
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
