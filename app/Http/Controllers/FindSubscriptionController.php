<?php

namespace App\Http\Controllers;

use App\Actions\Subscriptions\FindSubscriptionByStbMacAction;

class FindSubscriptionController extends Controller
{
    public function by_mac(string $mac): bool|array|string
    {
        $subscription = ((new FindSubscriptionByStbMacAction($mac))->handle());
        if ($subscription == false) {
            return false;
        }

        if (is_array($subscription)) {
            return $subscription;
        }

        return config('app.tivio_api').$subscription;
    }

    public function by_subscription(string $subscription): array
    {
        return [];
    }
}
