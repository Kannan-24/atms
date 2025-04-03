<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserStop extends Model
{
    protected $fillable = ['stop_id', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function stop()
    {
        return $this->belongsTo(Stop::class);
    }
}
