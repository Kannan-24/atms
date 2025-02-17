<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    protected $fillable = ['bus_number', 'starting_point' ];
    public function driver()
    {
        return $this->hasOneThrough(Driver::class, BusDriver::class, 'bus_id', 'id', 'id', 'driver_id');
    }
}
