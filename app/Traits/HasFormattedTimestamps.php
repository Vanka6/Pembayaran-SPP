<?php

namespace App\Traits;

trait HasFormattedTimestamps
{
    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at ? $this->created_at->format('d M Y H:i') : null;
    }

    public function getFormattedUpdatedAtAttribute()
    {
        return $this->updated_at ? $this->updated_at->format('d M Y H:i') : null;
    }
}
