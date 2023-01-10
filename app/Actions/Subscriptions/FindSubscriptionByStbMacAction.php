<?php

namespace App\Actions\Subscriptions;

use App\Models\Stb;

class FindSubscriptionByStbMacAction
{
    public function __construct(public string $mac)
    {
        //
    }

    public function handle(): bool|array|string
    {
        $stb = Stb::where('mac', strtolower($this->mac))->first();
        if (! $stb) {
            return false;
        }

        if ($stb->stb_type == 'KREA-1003') {
            return [
                'status' => 'error',
                'msg' => 'Tento typ set top boxu nepodporuje přeskakování reklam.',
            ];
        }
        $ispId = $stb->subscription->subscriber->ispId;

        return $ispId.'~~'.$stb->subscription->subscriptionCode;
    }
}
