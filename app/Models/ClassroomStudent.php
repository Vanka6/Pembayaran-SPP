<?php

namespace App\Models;

use App\Traits\HasFormattedTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassroomStudent extends Model
{
    use HasFactory, HasFormattedTimestamps;

    protected $table = 'classroom_student';
    protected $fillable = [
        'student_id',
        'departement_classroom_id',
        'school_year_id',
        'teacher_id',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function departementClassroom()
    {
        return $this->belongsTo(DepartementClassroom::class);
    }

    public function schoolYear()
    {
        return $this->belongsTo(SchoolYear::class);
    }
}
