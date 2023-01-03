<?php

namespace App\Actions\Subscriptions;

use App\Models\SubscriptionIdentity;

class FindSubscriptionByIdentityAction
{
    public function execute(int $identityId)
    {
        $identity = SubscriptionIdentity::find($identityId);

        return "fake_~~" . $identity->subscription->subscriptionCode;
    }
}
