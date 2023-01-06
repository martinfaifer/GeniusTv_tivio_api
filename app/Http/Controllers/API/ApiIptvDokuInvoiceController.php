<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Actions\Api\IptvDoku\GetInvoiceAction;
use App\Actions\Api\IptvDoku\GetInvoicesByIpsIdAction;

class ApiIptvDokuInvoiceController extends Controller
{
    public function show(User $user, GetInvoicesByIpsIdAction $getInvoicesByIpsIdAction)
    {
        return $getInvoicesByIpsIdAction->execute($user);
    }

    public function invoice(Request $request, GetInvoiceAction $getInvoiceAction)
    {
        // header('Content-Type: application/pdf');
        $file = Http
            ::withBasicAuth(config('app.iptv_doku_username'), config('app.iptv_doku_password'))
            ->post(config('app.iptv_doku_api') . "v1/nangu/isps/report", [
                'endpoint' => $request->path
            ])->body();

        header('Content-Type: application/pdf');

        response($file);
        // readfile($file);
        // return $getInvoiceAction->execute($request->path);
    }
}
