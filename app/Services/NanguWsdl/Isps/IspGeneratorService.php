<?php

namespace App\Services\NanguWsdl\Isps;

class IspGeneratorService
{
    public $idList = [];

    public function generate_isp_id()
    {
        for ($i = 0; $i <= 100; $i++) {
            array_push($this->idList, $i);
        }

        return $this->idList;
    }
}
