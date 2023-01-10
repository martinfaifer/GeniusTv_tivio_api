<?php

namespace App\Services\NanguWsdl\Actions;

use App\Models\Subscription;

class StoreSubscriptionAction
{
    public function __construct(public string $subscriptionCode, public int $subscriberId)
    {
        $this->store();
    }

    public function store(): void
    {
        try {
            Subscription::create([
                'subscriptionCode' => $this->subscriptionCode,
                'subscriberId' => $this->subscriberId,
            ]);
        } catch (\Throwable $th) {
        }
    }
}
