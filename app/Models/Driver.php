<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Driver extends Model
{
    protected $fillable = [
        'license',
        'address',
        'status',
        'user_id',
        'name',
        'phone',
        'email',
    ];

    /**
     * Get the user that owns the driver.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
