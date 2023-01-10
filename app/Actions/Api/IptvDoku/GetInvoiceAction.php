<?php

namespace App\Actions\Api\IptvDoku;

use Illuminate\Support\Facades\Http;

class GetInvoiceAction
{
    public function execute(string $path)
    {
        header('Content-Type: application/pdf');
        Http::withBasicAuth(config('app.iptv_doku_username'), config('app.iptv_doku_password'))
            ->post(config('app.iptv_doku_api').'v1/nangu/isps/report', [
                'endpoint' => $path,
            ]);
    }
}
