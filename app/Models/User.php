<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'school_id',
        'email',
        'password',
        'temporary_password',
        'role',
        'institution_id',
        'must_change_password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the institution that the user belongs to.
     */
    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    /**
     * Check if the user has a specific role.
     */
    public function hasRole($role): bool
    {
        return $this->role === $role;
    }

    /**
     * Check if the user is a super admin.
     */
    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }

    /**
     * Check if the user is an institutional admin.
     */
    public function isInstitutionalAdmin(): bool
    {
        return $this->role === 'institutional_admin';
    }

    /**
     * Check if the user is a student.
     */
    public function isStudent(): bool
    {
        return $this->role === 'student';
    }

    /**
     * Get the credentials that belong to this student.
     */
    public function credentials()
    {
        return $this->hasMany(Credential::class);
    }

    /**
     * Get the credentials issued by this institutional admin.
     */
    public function issuedCredentials()
    {
        return $this->hasMany(Credential::class, 'issued_by');
    }

    /**
     * Clear the temporary password when student changes their password.
     */
    public function clearTemporaryPassword()
    {
        $this->update([
            'temporary_password' => null,
            'must_change_password' => false,
        ]);
    }
}
