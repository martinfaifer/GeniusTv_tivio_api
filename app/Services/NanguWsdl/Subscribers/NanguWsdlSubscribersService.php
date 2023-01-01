<?php

namespace App\Services\NanguWsdl\Subscribers;

use App\Services\NanguWsdl\NanguWsdlService;
use App\Services\NanguWsdl\Actions\StoreSubscribersAction;
use App\Services\NanguWsdl\Isps\IspGeneratorService;

class NanguWsdlSubscribersService extends NanguWsdlService
{

    public $subscribers = [];
    public $limit = 0;

    public $wsdlResult = [];

    public function get_and_store(): void
    {
        $listOfIds = (new IspGeneratorService())->generate_isp_id();

        foreach ($listOfIds as $someId) {
            do {
                echo "ISP_ID " . $someId . PHP_EOL;
                $params = array('search' => array('ispCode' => $someId, 'firstResult' => $this->limit, 'orderBy' => "SUBSCRIBER_ID"));

                try {
                    $data = $this->soap->__soapCall('search', $params);
                    $wsdlResult = json_decode(json_encode($data), true);


                    if (isset($wsdlResult['subscribers'])) {
                        echo count($wsdlResult['subscribers']) . PHP_EOL;
                        foreach ($wsdlResult['subscribers'] as $subscriber) {
                            new StoreSubscribersAction($subscriber['subscriberCode'], $someId);
                        }
                    }

                    $this->limit += 20;
                } catch (\Throwable $th) {
                    echo "ISP NEEXISTUJE " . $someId . PHP_EOL;
                    $wsdlResult['count'] = 0;
                }
            } while ($wsdlResult['count'] > 499);
            $this->limit = 0;
            sleep(5);
        }
    }
}
