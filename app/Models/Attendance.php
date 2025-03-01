<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendance'; // If your table name is not pluralized

    protected $fillable = [
        'user_id',
        'check_in',
        'check_in_stop_id',
        'check_in_gps',
        'check_out',
        'check_out_stop_id',
        'check_out_gps',
        'towards_college',
        'status',
        'bus_id',
        'route_id',
        'distance_traveled'
    ];

    protected $casts = [
        'check_in' => 'datetime',
        'check_out' => 'datetime',
        'towards_college' => 'boolean',
        'distance_traveled' => 'float',
    ];

    // Relationship with User (Student)
    public function student()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship with Bus
    public function bus()
    {
        return $this->belongsTo(Bus::class, 'bus_id');
    }

    // Relationship with Route
    public function route()
    {
        return $this->belongsTo(Route::class, 'route_id');
    }
}
