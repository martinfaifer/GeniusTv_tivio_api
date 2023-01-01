<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TivioByMacRequest;
use App\Actions\Subscriptions\FindSubscriptionByStbMacAction;

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
}
