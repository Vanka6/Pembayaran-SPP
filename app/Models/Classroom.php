<?php

namespace App\Models;

use App\Models\Departement;
use App\Traits\HasFormattedTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classroom extends Model
{
    use HasFactory, HasFormattedTimestamps;

    protected $fillable = ['classroom_name'];

    /**
     * Tabel Relations
     */
    public function departements()
    {
        return $this->belongsToMany(Departement::class, 'departement_classroom')->withPivot('id')->withTimestamps();
    }
}
