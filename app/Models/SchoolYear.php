<?php

namespace App\Models;

use App\Traits\HasFormattedTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SchoolYear extends Model
{
    use HasFactory, HasFormattedTimestamps;

    protected $fillable = [
        'year_label',
        'start_date',
        'end_date',
        'description',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
    ];

    /**
     * Static Helper Method
     */
    public static function getActive()
    {
        $today = now()->toDateString();

        return self::where('start_date', '<=', $today)
            ->where('end_date', '>=', $today)
            ->first();
    }

    /**
     * Accessor
     */

    public function getStartDateForInputAttribute(): ?string
    {
        return $this->start_date?->format('Y-m-d');
    }

    public function getEndDateForInputAttribute(): ?string
    {
        return $this->end_date?->format('Y-m-d');
    }

    public function getFormattedStartDateAttribute()
    {
        return $this->start_date ? $this->start_date->format('d M Y') : null;
    }

    public function getFormattedEndDateAttribute()
    {
        return $this->end_date ? $this->end_date->format('d M Y') : null;
    }
}
