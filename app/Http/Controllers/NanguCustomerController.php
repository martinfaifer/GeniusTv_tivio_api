<?php

namespace App\Http\Controllers;

use App\Actions\Subscriptions\FindSubscriptionByIdentityAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Actions\Subscriptions\FindSubscriptionByStbMacAction;
use App\Services\NanguWsdl\Subscriptions\NanguWsdlShowSubscriptionInfoService;

class NanguCustomerController extends Controller
{
    public function show()
    {
        $subscriptionAndIspId = (new FindSubscriptionByIdentityAction())->execute(Auth::user()->identity);
        return (new NanguWsdlShowSubscriptionInfoService('subscription'))->show($subscriptionAndIspId);
    }
}
