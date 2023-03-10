<?php

namespace App\Http\Controllers\API;

use App\Actions\Api\IptvDoku\GetNanguIspsAction;
use App\Http\Controllers\Controller;

class ApiIptvDokuNanguIspsController extends Controller
{
    public function __invoke(GetNanguIspsAction $getNanguIspsAction)
    {
        return $getNanguIspsAction->execute();
    }
}
