<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'bus_id',
        'seat_number',
        'status'
    ];


    public function bus() {
        return $this->belongsTo(Bus::class);
    }

    public function seats() {
        return $this->hasMany(Booking::class);
    }


}
