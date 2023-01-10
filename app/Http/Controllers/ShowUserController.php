<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class ShowUserController extends Controller
{
    public function __invoke()
    {
        return Auth::user();
    }
}
