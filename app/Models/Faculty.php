<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;

    protected $table = 'faculty';
    
    protected $fillable = [
        'name',
        'phone',
        'email',
        'department',
        'designation',
        'address',
        'dob',
        'ts_id',
        'blood_group',
        'user_id',
        'dept_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function busIncharge()
    {
        return $this->hasMany(BusIncharge::class, 'faculty_id');
    }

    
    public function department()
    {
        return $this->belongsTo(Department::class, 'dept_id');
    }

    public function busDrivers()
    {
        return $this->belongsToMany(BusDriver::class, 'bus_driver_faculty', 'faculty_id', 'bus_driver_id');
    }


}
