<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusDriver extends Model
{
    protected $fillable = [
        'bus_id',
        'driver_id',    ];

    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }
    
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
