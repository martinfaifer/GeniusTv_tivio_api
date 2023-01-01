<?php

namespace App\Services\NanguWsdl\Actions;

use App\Models\SubscriptionIdentity;

class StoreSubscriptionIdentityAction
{
    public function __construct(public int $identityId, public string $username, public int $subscriptionId)
    {
    }

    public function store(): void
    {
        SubscriptionIdentity::create([
            'identityId' => $this->identityId,
            'username' => $this->username,
            'subscriptionId' => $this->subscriptionId
        ]);
    }
}
