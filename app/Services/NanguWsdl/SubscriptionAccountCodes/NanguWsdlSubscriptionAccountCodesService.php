<?php

namespace App\Services\NanguWsdl\SubscriptionAccountCodes;

use App\Models\Subscription;
use App\Services\NanguWsdl\Actions\StoreSubsciptionAccountCodeAction;
use App\Services\NanguWsdl\NanguWsdlService;

class NanguWsdlSubscriptionAccountCodesService extends NanguWsdlService
{
    public function get_and_store(): void
    {
        $subscriptions = Subscription::get();

        foreach ($subscriptions as $subscription) {
            try {
                $params = ['subscriptionCode' => ['subscriptionCode' => $subscription->subscriptionCode, 'ispCode' => $subscription->subscriber->ispId]];
                $data = $this->soap->__soapCall('getSubscriptionStbAccounts', $params);
                $wsdlResult = json_decode(json_encode($data), true);

                if (array_key_exists('subscriptionStbAccounts', $wsdlResult)) {
                    if (! array_key_exists('subscriptionStbAccountCode', $wsdlResult['subscriptionStbAccounts'])) {
                        foreach ($wsdlResult['subscriptionStbAccounts'] as $subscriptionAccount) {
                            try {
                                new StoreSubsciptionAccountCodeAction($subscriptionAccount['subscriptionStbAccountCode'], $subscription->id);
                            } catch (\Throwable $th) {
                            }
                        }
                    } else {
                        try {
                            new StoreSubsciptionAccountCodeAction($wsdlResult['subscriptionStbAccounts']['subscriptionStbAccountCode'], $subscription->id);
                        } catch (\Throwable $th) {
                        }
                    }
                }
            } catch (\Throwable $th) {
                echo $subscription->subscriptionCode.PHP_EOL;
            }
        }
    }
}
