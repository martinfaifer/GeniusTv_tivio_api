<?php

namespace App\Services\NanguWsdl\Subscriptions;

use App\Services\NanguWsdl\NanguWsdlService;

class NanguWsdlShowSubscriptionInfoService extends NanguWsdlService
{
    public function show(string $subscriptionCode)
    {
        $subscriptionCodeArray = explode("~~", $subscriptionCode);
        $params = array('subscriptionCode' => array('subscriptionCode' => $subscriptionCodeArray[1]));
        $data = $this->soap->__soapCall('getInfo', $params);
        $wsdlResult = json_decode(json_encode($data), true);
        return $wsdlResult;
    }
}
