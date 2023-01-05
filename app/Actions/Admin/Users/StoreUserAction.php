<?php

namespace App\Actions\Admin\Users;

use App\Models\User;
use App\Mail\SendWelcomeMail;
use Illuminate\Support\Facades\Mail;

class StoreUserAction
{
    public function execute(string $name, string $email, string $password, string|null $isAdmin = null, string|null $nanguIsp): bool
    {
        try {
            User::create([
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'isAdmin' => is_null($isAdmin) ? false : true,
                'nangu_isp' => is_null($nanguIsp) ? null : $nanguIsp
            ]);

            // send welcome email
            Mail::to($email)->queue(
                new SendWelcomeMail(
                    username: $email,
                    password: $password,
                    link: config('app.url') . "/#/admin/login"
                )
            );
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
