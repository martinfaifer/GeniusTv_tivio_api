<?php

namespace App\Actions\Admin\Users;

class UpdateUserAction
{
    public function execute(object $user, object $formData)
    {
        $updateData = [
            'isAdmin' => $formData->isAdmin
        ];

        if (!is_null($formData->password)) {
            $updateData['password'] = bcrypt($formData->password);
        }

        $user->update($updateData);
    }
}
