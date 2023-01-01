<?php
namespace App\Actions\Api\IptvDoku;

use Illuminate\Support\Facades\Http;

class GetChannelsAction
{
    public function handle()
    {
        return Http::get(config('app.iptv_doku_api') . "v1/public/channels")->json();
    }
}
