<?php

namespace App\Actions\Subscriptions\Auth;

use App\Models\SubscriptionIdentity;
use App\Models\User;
use App\Services\NanguWsdl\Identities\NanguWsdlIdentitySearchService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SubscriptionLoginAction
{
    public function execute(string $subscriberIdentityUsername, string|null $ispCode = null): mixed
    {
        // $identity = SubscriptionIdentity::where('username', $subscriberIdentityUsername)->first();
        $user = User::where('email', $subscriberIdentityUsername.'@genius.tv')->first();

        if (! $user) {
            $response = $this->find_and_manipulate($subscriberIdentityUsername, $ispCode);
            if ($response == false) {
                return false;
            }

            $user = $response;
        }

        Auth::login($user, true);

        return Auth::user();
    }

    protected function find_and_manipulate(string $subscriberIdentityUsername, string|null $ispCode = null): mixed
    {
        if (! is_null($ispCode)) {
            $getIdentity = (new NanguWsdlIdentitySearchService('identity'))->search(
                searcheable: $subscriberIdentityUsername,
                searchType: 'USERNAME',
                exact: true,
                ispCode: $ispCode
            );
        } else {
            $getIdentity = (new NanguWsdlIdentitySearchService('identity'))->search($subscriberIdentityUsername);
        }

        if ($getIdentity == false) {
            return false;
        }

        $user = User::create([
            'username' => $subscriberIdentityUsername,
            'email' => $subscriberIdentityUsername.'@genius.tv',
            'password' => bcrypt(Str::random(8)),
            'identity' => $getIdentity['identityId'],
            'mac' => $subscriberIdentityUsername.'_fake',
            'isAdmin' => false,
            'nangu_isp' => $ispCode,
        ]);

        return $user;
    }
}
