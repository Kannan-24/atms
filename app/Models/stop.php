<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Stop extends Model
{
    protected $fillable = ['stop_name', 'latitude', 'longitude', 'status'];

    public function users()
    {
        return $this->hasManyThrough(User::class, Student::class, 'stop_id', 'id', 'id', 'user_id');
    }

    public function route()
    {
        return $this->belongsTo(Route::class, 'route_stops', 'stop_id', 'route_id');
    }

    public static function findNearestStop($latitude, $longitude, $minDistance = 500, $maxDistance = 1500)
    {
        return self::selectRaw("
            id, name, latitude, longitude,
            ( 6371000 * acos(
                cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) +
                sin(radians(?)) * sin(radians(latitude))
            ) ) AS distance
        ", [$latitude, $longitude, $latitude])
            ->havingBetween('distance', [$minDistance, $maxDistance])
            ->orderBy('distance', 'asc')
            ->first();
    }
}
