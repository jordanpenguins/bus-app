<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'schedule_id',
        'user_id',
        'total_price',
        'status'
    ];


    public function schedule () {
        return $this-> belongsTo(Schedule::class);
    }

    public function passengers() {
        return $this->hasMany(Passenger::class);
    }

}
