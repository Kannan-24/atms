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

    public function routes()
    {
        return $this->belongsToMany(Route::class, 'route_stops', 'stop_id', 'route_id');
    }

}
