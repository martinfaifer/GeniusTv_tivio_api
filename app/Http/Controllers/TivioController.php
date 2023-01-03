<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TivioByMacRequest;
use App\Actions\Subscriptions\FindSubscriptionByStbMacAction;
use App\Http\Requests\TivioBySubscriptionCodeRequest;
use App\Models\Subscription;

class TivioController extends Controller
{
    public function by_mac(TivioByMacRequest $request)
    {
        $subscription = ((new FindSubscriptionByStbMacAction($request->mac))->handle());
        if ($subscription == false) {
            return false;
        }

        if (is_array($subscription)) {
            return $subscription;
        }

        return (config('app.tivio_api') . $subscription);
    }

    public function by_subscriptionCode(TivioBySubscriptionCodeRequest $request)
    {
        $subscription = Subscription::where('subscriptionCode', $request->subscriptionCode)->first();
        $ispId = $subscription->subscriber->ispId;
        return (config('app.tivio_api') . $ispId . "~~" . $request->subscriptionCode);
    }
}
