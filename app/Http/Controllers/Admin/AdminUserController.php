<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Admin\Users\DeleteUserAction;
use App\Actions\Admin\Users\StoreUserAction;
use App\Actions\Admin\Users\UpdateUserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\AdminShowUsersRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
            ? $this->success_message('Uživatel vytvořen')
            : $this->error_message('Nepodařilo se vytvořit uživatele');
    }

    public function update(UpdateUserRequest $request, User $user, UpdateUserAction $updateUserAction)
    {
        try {
            $updateUserAction->execute($user, $request);

            return $this->success_message('Upraveno');
        } catch (\Throwable $th) {
            return $this->error_message('Nepodařilo se upravit');
        }
    }

    public function destroy(User $user, DeleteUserAction $deleteUserAction)
    {
        return $deleteUserAction->execute($user) == true
            ? $this->success_message('Odebráno')
            : $this->error_message('Nemůžete mazat sami sebe!');
    }
}
