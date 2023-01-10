<?php

namespace App\Services\NanguWsdl\Subscriptions;

use App\Services\NanguWsdl\NanguWsdlService;

class NanguWsdlSubscriptionGetStbAccountInfoService extends NanguWsdlService
{
    public function getStbAccountInfo(string $subscriptionStbAccountCode, string|null $ispCode = null)
    {
        $requestArray = [
            'subscriptionStbAccountCode' => $subscriptionStbAccountCode,
        ];

        if (! is_null($requestArray)) {
            $requestArray['ispCode'] = $ispCode;
        }

        $params = ['getStbAccountInfo' => $requestArray];
        $data = $this->soap->__soapCall('getStbAccountInfo', $params);
        $wsdlResult = json_decode(json_encode($data), true);

        return $wsdlResult['subscriptionCode'];
    }
}
