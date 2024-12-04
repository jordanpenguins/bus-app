<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'schedule_id',
        'amount',
        'type',
        'priceID'
    ];
    
    public function schedule(){
        return $this->belongsTo(Schedule::class);

    }

    

}
