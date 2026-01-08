<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnavailableDate extends Model
{
     protected $fillable = ['venue_id', 'date'];

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }
}
