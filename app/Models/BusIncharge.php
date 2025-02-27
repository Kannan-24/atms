<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusIncharge extends Model
{
    protected $fillable = ['bus_id', 'faculty_id'];

    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class, 'faculty_id');
    }
}
