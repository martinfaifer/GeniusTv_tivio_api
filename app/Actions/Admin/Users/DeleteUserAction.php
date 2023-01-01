<?php

namespace App\Actions\Admin\Users;

use Illuminate\Support\Facades\Auth;

class DeleteUserAction
{
    public function execute(object $user): bool
    {
        if (Auth::user()->id != $user->id) {
            $user->delete();
            return true;
        }

        return false;
    }
}
