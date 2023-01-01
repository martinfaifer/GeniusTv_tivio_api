<?php

namespace App\Services\NanguWsdl\Stbs;

use App\Models\Subscription;
use App\Services\NanguWsdl\NanguWsdlService;
use App\Services\NanguWsdl\Actions\StoreStbAction;

class NanguWsdlStbService extends NanguWsdlService
{
    public function get_and_store(): void
    {
        $subscriptions = Subscription::get();

        foreach ($subscriptions as $subscription) {
            // try {
            echo $subscription->id . PHP_EOL;
            foreach ($subscription->subscriptionAccounts as $subscriptionAccount) {

                echo $subscription->subscriptionCode . PHP_EOL;
                // dd($subscriptionAccount->subscriptionStbAccountCode);
                $params = array('subscriptionCode' => array('subscriptionCode' => $subscription->subscriptionCode, 'subscriptionStbAccountCode' =>  $subscriptionAccount->subscriptionStbAccountCode, 'ispCode' => $subscription->subscriber->ispId));
                $data = $this->soap->__soapCall('getStbInfo', $params);
                $wsdlResult = json_decode(json_encode($data), true);
                if (array_key_exists('stb', $wsdlResult)) {
                    foreach ($wsdlResult as $stb) {
                        if (is_array($stb)) {
                            if (array_key_exists('macAddress', $stb)) {
                                try {
                                    (new StoreStbAction($stb['macAddress'], $stb['modelCode'], $subscription->id));
                                } catch (\Throwable $th) {
                                    // echo $stb['macAddress'] .  PHP_EOL;
                                }
                            }
                        }
                    }
                }
            }
            // } catch (\Throwable $th) {
            //     print_r($subscription) . PHP_EOL;
            // }
        }
    }
}
