<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class stop extends Model
{
    protected $fillable = ['stop_name', 'latitude', 'longitude', 'status'];

    public function userstops()
    {
        return $this->hasMany(Userstop::class);
    }
}
