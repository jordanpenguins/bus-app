<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'origin',
        'destination',
        'distance',
    ];


    public function schedule () {
        return $this->hasMany(Schedule::class);
    }
}
