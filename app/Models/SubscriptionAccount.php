<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubscriptionAccount extends Model
{
    protected $fillable = [
        'subscriptionStbAccountCode', 'subscriptionId'
    ];

    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class, 'subscriptionId', 'id');
    }
}
