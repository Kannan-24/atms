<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RouteStop extends Model
{
    use HasFactory;

    protected $table = 'route_stops';

    protected $fillable = [
        'route_id',
        'stop_id',
    ];

    public function route()
    {
        return $this->belongsTo(Route::class, 'route_id');
    }

    public function stop()
    {
        return $this->belongsTo(Stop::class, 'stop_id');
    }
}
