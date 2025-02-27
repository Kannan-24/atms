<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Stop extends Model
{
    protected $fillable = ['stop_name', 'latitude', 'longitude', 'status'];

    public function users(): HasMany
    {
        return $this->hasMany(UserStop::class);
    }
}
