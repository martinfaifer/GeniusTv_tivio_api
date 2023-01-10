<?php

namespace App\Http\Controllers;

use App\Actions\Subscriptions\FindSubscriptionByStbMacAction;
use App\Services\NanguWsdl\Subscriptions\NanguWsdlDeleteSubscriptionDeviceService;
use App\Services\NanguWsdl\Subscriptions\NanguWsdlShowSubscriptionInfoService;

class SubscriptionDeviceController extends Controller
{
    public function show(string $mac)
    {
        $subscription = ((new FindSubscriptionByStbMacAction($mac))->handle());
        if ($subscription == false) {
            return false;
        }

        if (is_array($subscription)) {
            return $subscription;
        }

        return (new NanguWsdlShowSubscriptionInfoService('subscription'))->show($subscription);
    }

    public function destroy(string $subscriptionCode, string $deviceId): array
    {
        return (new NanguWsdlDeleteSubscriptionDeviceService('subscription'))->delete($subscriptionCode, $deviceId) == true
            ? [
                'status' => 'success',
                'message' => 'Zařízení odebráno',
            ]
            : [
                'status' => 'error',
                'message' => 'Zařízení se nepodařilo odebrat nebo neexistuje',
            ];
    }
}
