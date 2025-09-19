<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\HasFormattedTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasFormattedTimestamps;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Table Relations
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function student()
    {
        return $this->hasOne(Student::class);
    }

    public function studentGuardian()
    {
        return $this->hasOne(StudentGuardian::class);
    }

    // public function employee()
    // {
    //     return $this->hasOne(Employee::class);
    // }

    /**
     * Helper Functions
     */

    public function hasRole(string $roleName): bool
    {
        return $this->roles()->where('name', $roleName)->exists();
    }

    /**
     * Accessor Function
     */
    public function getFullnameAttribute()
    {
        // Cek satu-satu kalau ada fullname, return yang ditemukan pertama kali
        if ($this->student && $this->student->fullname) {
            return $this->student->fullname;
        }

        if ($this->studentGuardian && $this->studentGuardian->fullname) {
            return $this->studentGuardian->fullname;
        }

        // if ($this->employee && $this->employee->fullname) {
        //     return $this->employee->fullname;
        // }

        // Default fallback kalau tidak ada fullname di mana-mana
        return $this->name ?? 'No Name';
    }
}
