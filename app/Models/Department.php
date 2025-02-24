<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['dept_name', 'degree', 'dept_code'];

    public function classes()
    {
        return $this->hasMany(Classes::class, 'dept_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'dept_id');
    }

    public function faculty()
    {
        return $this->hasMany(Faculty::class, 'dept_id');
    }
}
