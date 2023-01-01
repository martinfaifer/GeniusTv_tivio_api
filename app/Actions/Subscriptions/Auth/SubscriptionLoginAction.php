<?php

namespace App\Actions\Subscriptions\Auth;

use App\Models\Stb;
use App\Models\Sessions;
use App\Models\SubscriptionIdentity;
use App\Models\User;
use Illuminate\Queue\Middleware\RateLimited;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SubscriptionLoginAction
{
    public function execute(string $stbMac, string $subscriberIdentityUsername): bool|string
    {
        $user = User::where('name', $stbMac)->first();

        if (!$user || !Hash::check($subscriberIdentityUsername, $user->password)) {
            return false;
        }

        Auth::login($user, true);
        return Auth::user();
    }
}
