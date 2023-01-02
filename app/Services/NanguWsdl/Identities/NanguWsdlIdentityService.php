<?php

namespace App\Services\NanguWsdl\Identities;

use App\Models\Subscriber;
use App\Models\SubscriptionAccount;
use App\Services\NanguWsdl\NanguWsdlService;
use App\Services\NanguWsdl\Actions\StoreSubscriptionIdentityAction;

class NanguWsdlIdentityService extends NanguWsdlService
{
    public function get_and_store()
    {
        $subscriptionsAccounts = SubscriptionAccount::get();
        foreach ($subscriptionsAccounts as $subscriptionAccount) {

            try {
                $params = array('subscriptionStbAccountCode' => array('subscriptionStbAccountCode' =>  $subscriptionAccount->subscriptionStbAccountCode, 'ispCode' => Subscriber::find($subscriptionAccount->subscription->subscriberId)->ispId));
                $data = $this->soap->__soapCall('getStbAccountInfo', $params);
                $wsdlResult = json_decode(json_encode($data), true);
                if (array_key_exists('identities', $wsdlResult)) {
                    print_r($wsdlResult);
                    if (array_key_exists(1, $wsdlResult['identities'])) {
                        foreach ($wsdlResult['identities'] as $result) {
                            if (array_key_exists('identityId', $result) && array_key_exists('username', $result)) {
                                (new StoreSubscriptionIdentityAction($result['identityId'], $result['username'], $subscriptionAccount->subscription->id))->store();
                            }
                        }
                    } else {
                        if (array_key_exists('identityId', $wsdlResult['identities'])) {
                            (new StoreSubscriptionIdentityAction($wsdlResult['identities']['identityId'], $wsdlResult['identities']['username'], $subscriptionAccount->subscription->id))->store();
                        }
                    }
                }
            } catch (\Throwable $th) {
                //throw $th;
            }
        }
    }
}
