<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Actions\Api\IptvDoku\GetNanguIspsAction;

class ApiIptvDokuNanguIspsController extends Controller
{
    public function __invoke(GetNanguIspsAction $getNanguIspsAction)
    {
        return $getNanguIspsAction->execute();
    }
}
