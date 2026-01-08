<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Venue;
use App\Models\User;


class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'venue_id',
        'booking_date',
        'purpose',
        'booksession',
        'status',
        'admin_reason',
        'cancelled_by',
    ];

    public function venue()
{
    return $this->belongsTo(Venue::class);
}

public function user()
{
    return $this->belongsTo(User::class);
}

}
