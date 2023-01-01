<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Actions\Subscriptions\FindSubscriptionByStbMacAction;
use App\Services\NanguWsdl\Subscriptions\NanguWsdlShowSubscriptionInfoService;

class NanguCustomerController extends Controller
{
    public function show()
    {
        $subscriptionAndIspId = (new FindSubscriptionByStbMacAction(Auth::user()->name))->handle();
        return (new NanguWsdlShowSubscriptionInfoService('subscription'))->show($subscriptionAndIspId);
    }
}
