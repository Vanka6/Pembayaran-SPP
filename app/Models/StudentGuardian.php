<?php

namespace App\Models;

use App\Enums\StudentGuardianRelationType;
use App\Traits\HasFormattedTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentGuardian extends Model
{
    use HasFactory, HasFormattedTimestamps;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'student_id',
        'fullname',
        'phone_number',
        'relation_type',
        'address',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'relation_type' => StudentGuardianRelationType::class,
    ];

    protected static function booted()
    {
        static::deleting(function ($guardian) {
            // Hapus akun user wali
            $guardian->user?->delete();
        });
    }


    /**
     * Get the user that owns the guardian.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the student associated with the guardian.
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
