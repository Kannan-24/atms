<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusStops extends Model
{
    protected $table = 'bus_stops';
    protected $fillable = ['name', 'latitude', 'longitude'];
    public $timestamps = false;
}
