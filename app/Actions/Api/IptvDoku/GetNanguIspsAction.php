<?php

namespace App\Actions\Api\IptvDoku;

use Illuminate\Support\Facades\Http;

class GetNanguIspsAction
{
    public function execute()
    {
        return Http
            ::withBasicAuth(config('app.iptv_doku_username'), config('app.iptv_doku_password'))
            ->get(config('app.iptv_doku_api') . "v1/nangu/isps")->json();
    }
}
