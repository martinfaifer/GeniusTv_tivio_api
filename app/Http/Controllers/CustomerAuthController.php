<?php

namespace App\Http\Controllers;

use App\Http\Resources\ShowCustomerResource;
use Illuminate\Http\Request;
use App\Http\Requests\CustomerLoginRequest;
use App\Actions\Subscriptions\Auth\SubscriptionLoginAction;
use Illuminate\Support\Facades\Auth;

class CustomerAuthController extends Controller
{

    public function show()
    {
        return Auth::user();
    }

    public function login(CustomerLoginRequest $request, SubscriptionLoginAction $subscriptionLoginAction)
    {
        $responseAction = $subscriptionLoginAction->execute($request->mac, $request->identity);
        return $responseAction  == false
            ? $this->error_message("Nepodařilo se najít uživatele")
            : $this->success_message('Úspěšně přihlášeno', "/customer");
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
    }
}
