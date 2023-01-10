<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stb extends Model
{
    protected $fillable = [
        'mac', 'subscriptionId', 'stb_type',
    ];

    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class, 'subscriptionId', 'id');
    }
}
