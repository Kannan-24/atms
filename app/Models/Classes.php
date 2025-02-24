<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    protected $fillable = ['dept_id', 'batch_id', 'section'];

    public function department()
    {
        return $this->belongsTo(Department::class, 'dept_id');
    }

    public function batch() // ✅ Use singular name for belongsTo
    {
        return $this->belongsTo(Batches::class, 'batch_id');
    }

    public function students() // ✅ Use plural name for hasMany
    {
        return $this->hasMany(Student::class, 'class_id');
    }
}
