<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'bus_id',
        'route_id',
        'depature_time',
        'arrival_time',
        'schedule_date',
        'price'
    ];


    public function bookings(){
        return $this -> hasMany(Booking::class);
    }

    public function route(){
        return $this -> belongsTo(Route:: class);
    }

    public function buses(){
        return $this -> belongsTo(Bus::class);
    }


}
