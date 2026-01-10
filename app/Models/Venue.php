<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    protected $table = 'venues';

    protected $fillable = [
        'name',
        'location',
        'capacity',
        'is_available',
        'image',
    ];

    public function bookings()
{
    return $this->hasMany(Booking::class);
}
    public function unavailableDates()
{
    return $this->hasMany(UnavailableDate::class);
}


}
