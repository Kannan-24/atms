<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    protected $fillable = [
        'number',
        'number_plate',
        'no_of_seats',
    ];
}
