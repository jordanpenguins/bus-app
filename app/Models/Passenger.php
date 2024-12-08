<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'booking_id',
        'passport_number',
        'passport_expiry_date',
        'seat_id',
        'nationality'
    ];

    public function seating() {
        return $this->belongsTo(Seat::class);
    }
}
