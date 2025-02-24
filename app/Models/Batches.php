<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batches extends Model
{
    use HasFactory;

    protected $table = 'batches'; // Ensure this matches your database table name
    protected $fillable = ['start_year', 'end_year'];

    public function classes()
    {
        return $this->hasMany(Classes::class, 'batch_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'batch_id');
    }
}
