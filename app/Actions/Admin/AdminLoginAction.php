<?php

namespace App\Actions\Admin;

use Illuminate\Support\Facades\Auth;

class AdminLoginAction
{
    public function execute(string $email, string $password): array
    {
        if (Auth::attempt(['email' => $email, 'password' => $password], true)) {

            $user = Auth::user();
            if (is_null($user->mac) && is_null($user->identity)) {
                return [
                    'status' => "success",
                    'message' => "Přihlášeno"
                ];
            }

            Auth::logout();

            return [
                'status' => "warning",
                'message' => "Nemáte oprávnění."
            ];
        }

        return [
            'status' => "error",
            'message' => "Neplatné přiglašovací údaje"
        ];
    }
}
