<?php

namespace App\Services\NanguWsdl\Actions;

use App\Models\SubscriptionAccount;

class StoreSubsciptionAccountCodeAction
{
    public function __construct(public string $subscriptionStbAccountCode, public int $subscriptionId)
    {
        $this->store();
    }

    public function store(): void
    {
        SubscriptionAccount::create([
            'subscriptionStbAccountCode' => $this->subscriptionStbAccountCode,
            'subscriptionId' => $this->subscriptionId,
        ]);
    }
}
