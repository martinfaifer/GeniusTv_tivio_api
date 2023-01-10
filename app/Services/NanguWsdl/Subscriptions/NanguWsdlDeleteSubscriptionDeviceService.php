<?php

namespace App\Services\NanguWsdl\Subscriptions;

use App\Services\NanguWsdl\NanguWsdlService;

class NanguWsdlDeleteSubscriptionDeviceService extends NanguWsdlService
{
    public function delete(string $ubscriptionCode, string $deviceId): bool
    {
        try {
            $params = ['subscriptionCode' => ['subscriptionCode' => $ubscriptionCode, 'deviceId' => $deviceId]];
            $this->soap->__soapCall('removeDevice', $params);

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
