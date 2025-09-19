<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartementClassroom extends Model
{
    use HasFactory;

    protected $table = 'departement_classroom';
    protected $fillable = [
        'departement_id',
        'classroom_id',
    ];

    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function classroomStudents()
    {
        return $this->hasMany(ClassroomStudent::class);
    }
}
