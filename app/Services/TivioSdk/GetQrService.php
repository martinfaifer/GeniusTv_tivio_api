<?php

namespace App\Services\TivioSdk;

use Illuminate\Support\Facades\Http;

class GetQrService
{

    public $tivioUrl;

    public function __construct()
    {
        $this->tivioUrl = config("app.tivio_api");
    }


    function get(string $subscription)
    {
        return Http::get($this->tivioUrl . $subscription);
    }
}
