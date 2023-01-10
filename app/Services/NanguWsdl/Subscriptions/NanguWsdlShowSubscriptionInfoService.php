<?php

namespace App\Services\NanguWsdl\Subscriptions;

use App\Services\NanguWsdl\NanguWsdlService;

class NanguWsdlShowSubscriptionInfoService extends NanguWsdlService
{
    public function show(string $subscriptionCode, string|null $ispCode = null)
    {
        // $subscriptionCodeArray = explode("~~", $subscriptionCode);

        $requestArray = [
            'subscriptionCode' => $subscriptionCode,
        ];

        if (!is_null($requestArray)) {
            $requestArray['ispCode'] = $ispCode;
        }

        $params = array('subscriptionCode' => $requestArray);
        $data = $this->soap->__soapCall('getInfo', $params);
        $wsdlResult = json_decode(json_encode($data), true);
        return $wsdlResult;
    }
}
