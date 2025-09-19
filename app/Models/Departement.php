<?php

namespace App\Models;

use App\Models\Classroom;
use App\Traits\HasFormattedTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Departement extends Model
{
    use HasFactory, HasFormattedTimestamps;

    protected $fillable = ['departement_name'];

    /**
     * Tabel Relations
     */
    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class, 'departement_classroom')->withPivot('id')->withTimestamps();
    }
}
