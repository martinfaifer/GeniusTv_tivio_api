<?php

namespace App\Actions\Subscriptions\Auth\User;

use App\Models\User;

class DeleteCustomerUserAction
{
    public function execute(string $emailByIdentity)
    {
        $email = $emailByIdentity . "@genius.tv";

        $user = User::where('email', $email)->where('mac', $emailByIdentity . "_fake")->first();
        if ($user) {
            $user->delete();
        }
    }
}
