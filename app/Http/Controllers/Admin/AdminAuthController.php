<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Admin\AdminLoginAction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function login(AdminLoginRequest $request, AdminLoginAction $adminLoginAction)
    {
        return $adminLoginAction->execute($request->email, $request->password);
    }

    public function logged()
    {
        return Auth::user();
    }

    public function logout()
    {
        Auth::logout();
    }
}
