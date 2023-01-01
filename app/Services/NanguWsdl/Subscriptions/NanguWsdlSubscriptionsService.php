<?php

namespace App\Services\NanguWsdl\Subscriptions;

use App\Models\Subscriber;
use App\Services\NanguWsdl\NanguWsdlService;
use App\Services\NanguWsdl\Actions\StoreSubscriptionAction;

class NanguWsdlSubscriptionsService extends NanguWsdlService
{
    public function get_and_store(): void
    {
        $subscribers = Subscriber::get();

        foreach ($subscribers as $subscriber) {
            try {
                $params = array('subscriberCode' => array('subscriberCode' => $subscriber['subscriberCode'], 'ispCode' => $subscriber['ispId']));

                $data = $this->soap->__soapCall('getSubscriptions', $params);
                $wsdlResult = json_decode(json_encode($data), true);
                print_r($wsdlResult);
                if (array_key_exists('subscriptions', $wsdlResult)) {
                    if (array_key_exists('subscriptionCode', $wsdlResult['subscriptions'])) {
                        new StoreSubscriptionAction($wsdlResult['subscriptions']['subscriptionCode'], $subscriber->id);
                    } else {
                        foreach($wsdlResult['subscriptions'] as $subscription) {
                            new StoreSubscriptionAction($subscription['subscriptionCode'], $subscriber->id);
                        }
                    }

                }
            } catch (\Throwable $th) {
                echo "ISP NEEXISTUJE ";
            }
        }
    }
}
