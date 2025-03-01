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

    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'bus_id');
    }


}
