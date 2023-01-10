<?php

namespace App\Services\NanguWsdl\Identities;

use App\Services\NanguWsdl\NanguWsdlService;

class NanguWsdlIdentityGetInfoService extends NanguWsdlService
{
    public function getSubscriptionAccountCode(string $identityId, string|null $ispCode = null)
    {
        $requestArray = [
            'identityId' => $identityId,
        ];

        if(!is_null($ispCode)) {
            $requestArray['ispCode'] = $ispCode;
        }

        $params = array('getInfo' => $requestArray);
        $data = $this->soap->__soapCall('getInfo', $params);
        $wsdlResult = json_decode(json_encode($data), true);

        if (!array_key_exists("subscriptionStbAccounts", $wsdlResult)) {
            return false;
        }

        if (array_key_exists("subscriptionStbAccountCode", $wsdlResult['subscriptionStbAccounts'])) {
            return $wsdlResult['subscriptionStbAccounts']['subscriptionStbAccountCode'];
        }

        foreach ($wsdlResult['subscriptionStbAccounts'] as $subscriptionStbAccount) {
            return $subscriptionStbAccount['subscriptionStbAccountCode'];
        }
    }
}
