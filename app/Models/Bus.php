<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'number',
        'seats',
        'type',
    ];


    public function schedule() {
        return $this->hasMany(Schedule::class);
    }

    public function seat() {
        return $this->hasMany(Seat::class);

    }
}
