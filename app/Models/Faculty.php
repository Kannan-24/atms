<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $fillable = ['name', 'email', 'employee_id', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
