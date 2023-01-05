<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreUserRequest;
use App\Actions\Admin\Users\StoreUserAction;
use App\Actions\Admin\Users\DeleteUserAction;
use App\Http\Resources\AdminShowUsersRequest;

class AdminUserController extends Controller
{
    public function index()
    {
        return new AdminShowUsersRequest(Auth::user());
    }

    public function store(StoreUserRequest $request, StoreUserAction $storeUserAction)
    {
        return $storeUserAction->execute(
            name: $request->name,
            email: $request->email,
            password: $request->password,
            isAdmin: $request->isAdmin,
            nanguIsp: $request->nanguIsp
        ) == true
            ? $this->success_message("Uživatel vytvořen")
            : $this->error_message("Nepodařilo se vytvořit uživatele");
    }

    public function destroy(User $user, DeleteUserAction $deleteUserAction)
    {
        return $deleteUserAction->execute($user) == true
            ? $this->success_message("Odebráno")
            : $this->error_message("Nemůžete mazat sami sebe!");
    }
}
