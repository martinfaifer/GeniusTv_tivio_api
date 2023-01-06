<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Actions\Api\IptvDoku\GetInvoiceAction;
use App\Actions\Api\IptvDoku\GetInvoicesByIpsIdAction;
use GuzzleHttp\Client;

class ApiIptvDokuInvoiceController extends Controller
{
    public function show(User $user, GetInvoicesByIpsIdAction $getInvoicesByIpsIdAction)
    {
        return $getInvoicesByIpsIdAction->execute($user);
    }

    public function invoice(Request $request, GetInvoiceAction $getInvoiceAction)
    {

        $auth = base64_encode(config('app.iptv_doku_username') . ":" . config('app.iptv_doku_password'));
        $context = stream_context_create([
            "http" => [
                "header" => "Authorization: Basic $auth"
            ]
        ]);

        $postdata = http_build_query(
            array(
                'endpoint' => $request->path
            )
        );

        $opts = array(
            'http' => [
                'method'  => 'POST',
                'header'  => [
                    'Content-Type: application/x-www-form-urlencoded',
                    "Authorization: Basic $auth",
                ],
                'content' => $postdata
            ]
        );

        $context  = stream_context_create($opts);

        $result = file_get_contents(config('app.iptv_doku_api') . "v1/nangu/isps/report", false, $context);

        header('Content-Type: application/pdf');
        echo $result;
    }
}
