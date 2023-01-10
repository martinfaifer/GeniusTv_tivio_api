<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubscriptionIdentity extends Model
{
    protected $fillable = [
        'identityId', 'username', 'subscriptionId',
    ];

    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class, 'subscriptionId', 'id');
    }
}
