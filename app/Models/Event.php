<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public function galleries()
    {
        return $this->hasMany(EventImage::class, 'parent_id', 'id');
    }

    public function bts_events()
    {
        return $this->hasMany(BTS::class, 'event_id', 'id');
    }
}
