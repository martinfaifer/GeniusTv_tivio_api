<?php

namespace App\Services\NanguWsdl\Subscriptions;

use App\Services\NanguWsdl\NanguWsdlService;

class NanguWsdlDeleteSubscriptionDeviceService extends NanguWsdlService
{
    public function delete(string $ubscriptionCode, string $deviceId, $ispId = null): bool
    {
        try {
            if (is_null($ispId)) {
                $params = ['subscriptionCode' => ['subscriptionCode' => $ubscriptionCode, 'deviceId' => $deviceId]];
            } else {
                $params = ['subscriptionCode' => ['subscriptionCode' => $ubscriptionCode, 'deviceId' => $deviceId, 'ispCode' => $ispId]];
            }


            $this->soap->__soapCall('removeDevice', $params);

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
