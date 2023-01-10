<?php

use App\Models\Stb;
use App\Models\SubscriptionIdentity;
use App\Models\User;
use App\Services\NanguWsdl\Identities\NanguWsdlIdentityService;
use App\Services\NanguWsdl\Isps\IspGeneratorService;
use App\Services\NanguWsdl\Stbs\NanguWsdlStbService;
use App\Services\NanguWsdl\Subscribers\NanguWsdlSubscribersService;
use App\Services\NanguWsdl\SubscriptionAccountCodes\NanguWsdlSubscriptionAccountCodesService;
use App\Services\NanguWsdl\Subscriptions\NanguWsdlSubscriptionsService;
use Illuminate\Support\Facades\Artisan;

Artisan::command('getSubscribers_and_store', function () {
    (new NanguWsdlSubscribersService('getSubscribers_and_store'))->get_and_store();
});

// Artisan::command('generate_isp', function () {
//     (new IspGeneratorService())->generate_isp_id();
// });

// Artisan::command('subscriptions', function () {
//     (new NanguWsdlSubscriptionsService('subscriber'))->get_and_store();
// });

Artisan::command('stbAcc', function () {
    (new NanguWsdlSubscriptionAccountCodesService('subscription'))->get_and_store();
});

Artisan::command('getStb', function () {
    (new NanguWsdlStbService('subscription'))->get_and_store();
});

Artisan::command('test_nodejs', function () {
    //
});

Artisan::command('identity', function () {
    dd((new NanguWsdlIdentityService('subscription'))->get_and_store());
});

Artisan::command('bind', function () {
    User::where('mac', '!=', null)->delete();

    $identities = SubscriptionIdentity::get();
    foreach ($identities as $identity) {
        $stbs = Stb::where('subscriptionId', $identity->subscriptionId)->get();
        foreach ($stbs as $stb) {
            User::create([
                'identity' => $identity->username,
                'mac' => $stb->mac,
                'password' => bcrypt($identity->username),
            ]);
        }
    }
});
