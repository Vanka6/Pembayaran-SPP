<?php

namespace App\Models;

use App\Traits\HasFormattedTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory, HasFormattedTimestamps;
    protected $guarded = ['id'];

    /**
     * Table Relations
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'permission_role');
    }
}
