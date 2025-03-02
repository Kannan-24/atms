<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    protected $fillable = [
        'number',
        'number_plate',
        'no_of_seats',
    ];


    public function drivers()
    {
        return $this->hasMany(BusDriver::class);
    }

    public function facultyIncharge()
    {
        return $this->hasOne(BusIncharge::class, 'bus_id');
    }

    public function busDriver()
    {
        return $this->hasOne(BusDriver::class, 'bus_id');
    }

    public function locations()
    {
        return $this->hasMany(BusLocation::class);
    }

    public function route()
    {
        return $this->hasOneThrough(Route::class, BusRoute::class, 'bus_id', 'id', 'id', 'route_id');
    }

    public function getStudentsAttribute()
    {
        $stops = $this->route->stops;

        return Student::with('stop')->whereHas('stop', function ($query) use ($stops) {
            $query->whereIn('stop_id', $stops->pluck('id'));
        })->get();
    }
}
