<?php

namespace App\Http\Controllers;

use App\Actions\Api\IptvDoku\GetChannelsAction;

class ChannelController extends Controller
{
    public function __invoke(GetChannelsAction $getChannelsAction)
    {
        return $getChannelsAction->handle();
    }
}
