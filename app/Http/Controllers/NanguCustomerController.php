<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Actions\Subscriptions\FindSubscriptionByStbMacAction;
use App\Actions\Subscriptions\FindSubscriptionByIdentityAction;
use App\Services\NanguWsdl\Identities\NanguWsdlIdentityGetInfoService;
use App\Services\NanguWsdl\Subscriptions\NanguWsdlShowSubscriptionInfoService;
use App\Services\NanguWsdl\Subscriptions\NanguWsdlSubscriptionGetStbAccountInfoService;

class NanguCustomerController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        // $subscriptionAndIspId = (new FindSubscriptionByIdentityAction())->execute($user->identity);
        $getSubscriptionAccountCode = (new NanguWsdlIdentityGetInfoService('identity'))->getSubscriptionAccountCode($user->identity, $user->nangu_isp);
        $subscriptionCode = (new NanguWsdlSubscriptionGetStbAccountInfoService('subscription'))->getStbAccountInfo($getSubscriptionAccountCode, $user->nangu_isp);
        return (new NanguWsdlShowSubscriptionInfoService('subscription'))->show($subscriptionCode, $user->nangu_isp);
    }
}
