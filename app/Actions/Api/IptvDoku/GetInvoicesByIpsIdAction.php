<?php

namespace App\Actions\Api\IptvDoku;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class GetInvoicesByIpsIdAction
{
    public function execute(object $user)
    {
        if (Auth::user()->id != $user->id) {
            return [];
        }

        if (is_null($user->nangu_isp)) {
            return [];
        }

        return Http
            ::withBasicAuth(config('app.iptv_doku_username'), config('app.iptv_doku_password'))
            ->get(config('app.iptv_doku_api') . "v1/nangu/isps/reports/" . $user->nangu_isp)->json();
    }
}
