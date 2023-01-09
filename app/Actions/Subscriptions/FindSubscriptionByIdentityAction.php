<?php

namespace App\Actions\Subscriptions;

use App\Models\Subscriber;
use App\Models\SubscriptionIdentity;

class FindSubscriptionByIdentityAction
{
    public function execute(int $identityId)
    {
        $identity = SubscriptionIdentity::find($identityId);
        $subscriber = Subscriber::find($identity->subscription->subscriberId);

        return $subscriber->ispId . "~~" . $identity->subscription->subscriptionCode;
    }
}
