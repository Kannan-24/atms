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
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'dept_id');
    }
}
