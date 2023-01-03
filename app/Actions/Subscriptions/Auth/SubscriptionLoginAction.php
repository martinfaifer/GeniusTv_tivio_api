<?php

namespace App\Actions\Subscriptions\Auth;

use App\Models\Stb;
use App\Models\Sessions;
use App\Models\SubscriptionIdentity;
use App\Models\User;
use Illuminate\Queue\Middleware\RateLimited;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SubscriptionLoginAction
{
    public function execute(string $subscriberIdentityUsername): mixed
    {
        $identity = SubscriptionIdentity::where('username', $subscriberIdentityUsername)->first();
        $user = User::where('identity', $identity->id)->first();

        if (!$user) {
            $user = User::create([
                'name' => $subscriberIdentityUsername,
                'email' => $subscriberIdentityUsername . "@geniustv.cz",
                'password' => bcrypt(Str::random(8)),
                'identity' => $identity->id,
                'mac' => $subscriberIdentityUsername . "_fake",
                'isAdmin' => false
            ]);
        }

        // if (!$user || !Hash::check($subscriberIdentityUsername, $user->password)) {
        //     return false;
        // }

        Auth::login($user, true);
        return Auth::user();
    }
}
