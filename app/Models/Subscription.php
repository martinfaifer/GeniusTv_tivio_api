<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subscription extends Model
{
    protected $fillable = [
        'subscriptionCode', 'subscriberId'
    ];

    public function subscriber(): BelongsTo
    {
        return $this->belongsTo(Subscriber::class, 'subscriberId', 'id');
    }

    public function subscriptionAccounts(): HasMany
    {
        return $this->hasMany(SubscriptionAccount::class, 'subscriptionId', 'id');
    }

    public function stbs(): HasMany
    {
        return $this->hasMany(Stb::class, 'subscriptionId', 'id');
    }
}
