<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actions\Api\IptvDoku\GetChannelsAction;

class ChannelPackageCountController extends Controller
{

    public $channelPackageZaklad = "G.TV Základ";
    public $channelPackageStandart = "G.TV Standard";
    public $channelPackageKomplet = "G.TV Komplet";

    public function show($package, GetChannelsAction $getChannelsAction)
    {
        $channels = $getChannelsAction->handle();

        return $this->find_channels($channels, $package);
    }

    protected function find_channels(array $channels, string $package)
    {
        $channelsByPackage = [];
        $hdChannelsByPackage = [];
        foreach ($channels as $channel) {
            if (str_contains($channel['channelPackages'], $package)) {
                // select radií
                if (is_null($channel['is_radio'])) {
                    array_push($channelsByPackage, $channel['id']);

                    if (str_contains($channel['kvalita'], "HD")) {
                        array_push($hdChannelsByPackage, $channel['id']);
                    }
                }
            }
        }
        if (empty($channelsByPackage)) {
            return [];
        }
        return [
            "package" => $package,
            "all" => count($channelsByPackage),
            "hd" => count($hdChannelsByPackage)
        ];
    }
}
