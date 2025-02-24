<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'roll_number',
        'department',
        'class',
        'section',
        'roll_no',
        'blood_group',
        'address',
        'class_id',
        'dob',
        'user_id',
        'dept_id',
        'batch_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function batch()
    {
        return $this->belongsTo(Batches::class, 'batch_id');
    }

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'dept_id');
    }
    
}
