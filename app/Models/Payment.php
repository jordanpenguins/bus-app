<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'booking_id',
        'amount',
        'status',
        'transaction_id'
    ];


    
    public function booking() {
        return $this->belongsTo(Booking::class);
    }

    
}
