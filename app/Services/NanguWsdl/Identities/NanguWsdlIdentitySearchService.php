<?php

namespace App\Services\NanguWsdl\Identities;

use App\Services\NanguWsdl\NanguWsdlService;

class NanguWsdlIdentitySearchService extends NanguWsdlService
{
    public function search(string $searcheable, string $searchType = 'USERNAME', bool $exact = true, string|null $ispCode = null)
    {
        $requestArray = [
            'searchText' => $searcheable,
            'searchType' => $searchType,
            'exact' => $exact,
        ];

        if (! is_null($ispCode)) {
            $requestArray['ispCode'] = $ispCode;
        }

        $params = ['search' => $requestArray];
        $data = $this->soap->__soapCall('search', $params);
        $wsdlResult = json_decode(json_encode($data), true);

        if ($wsdlResult['count'] == 0) {
            return false;
        }

        return $wsdlResult['identities'];
    }
}
