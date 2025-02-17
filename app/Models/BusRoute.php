<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusRoute extends Model
{
    protected $fillable = ['route_name', 'start_point', 'end_point', 'bus_id'];

    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }

    public function busStops()
    {
        return $this->hasMany(BusStop::class);
    }
}
