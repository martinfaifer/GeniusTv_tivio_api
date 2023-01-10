<?php

namespace App\Services\NanguWsdl;

use SoapClient;

use Exception;

class NanguWsdlService
{

    public array $wsdlEndPoints = [
        'billing' => 'billing/BillingEndpoint?wsdl',
        'subscription' => 'provisioning/SubscriptionEndpoint?wsdl',
        'subscriber' => 'provisioning/SubscriberEndpoint?wsdl',
        'iptv' => 'iptv/IptvEndpoint?wsdl',
        'identity' => 'provisioning/IdentityEndpoint?wsdl'
    ];

    public $soap;

    public function __construct(public string $endPoint)
    {
        if (is_null(config('app.nangu_wsdl_url'))) {
            throw new Exception("Dont exist nangu url");
        }

        $this->soap = (!is_null(config('app.nangu_wsdl_url')))
            ? new SoapClient(config('app.nangu_wsdl_url') . $this->available_endpoints())
            : [];
    }

    public function available_endpoints()
    {
        if (array_key_exists($this->endPoint, $this->wsdlEndPoints)) {
            return $this->wsdlEndPoints[$this->endPoint];
        }
    }
}
