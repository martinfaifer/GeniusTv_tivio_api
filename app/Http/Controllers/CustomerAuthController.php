<?php

namespace App\Http\Controllers;

use App\Actions\Nangu\GraphQL\oAuth\NanguOAuthGraphQlAction;
use App\Actions\Subscriptions\Auth\SubscriptionLoginAction;
use App\Http\Requests\CustomerLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerAuthController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        if (is_null($user)) {
            return null;
        }

        if (is_null($user->mac)) {
            Auth::logout();

            return null;
        }

        return [
            'id' => $user->id,
            'identity' => $user->identity,
            'nangu_isp' => $user->nangu_isp
        ];
    }

    public function login(CustomerLoginRequest $request, SubscriptionLoginAction $subscriptionLoginAction, NanguOAuthGraphQlAction $nanguOAuthGraphQlAction)
    {
        $oauthResponse = $nanguOAuthGraphQlAction->execute($request->identity_username, $request->identity_password);
        if (!array_key_exists('login', $oauthResponse)) {
            return $this->error_message('Nepodařilo se najít uživatele');
        }
        $responseAction = $subscriptionLoginAction->execute($request->identity_username, $request->ispCode);

        return $responseAction == false
            ? $this->warning('Nepodařilo se najít uživatele, prosím specifikujte svého poskytovatele IPTV')
            : $this->success_message('Úspěšně přihlášeno', '/customer');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
    }
}
