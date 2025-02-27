<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusDriver extends Model
{
    protected $fillable = ['bus_id', 'driver_id', 'valid_from', 'valid_to'];

    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function faculty()
    {
        return $this->belongsToMany(Faculty::class, 'bus_driver_faculty', 'bus_driver_id', 'faculty_id');
    }

    public function department()
    {
        return $this->belongsToMany(Department::class);
    }
}
