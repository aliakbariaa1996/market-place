<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;

class UserRepository implements UserRepositoryInterface
{


    public function userList()
    {
        return User::all();
    }

    public function makeSeller(int $user_id)
    {
        if (!UserRole::whereUserId($user_id)->whereRoleId(Role::SELLER_ROLE_ID)->count()) {
            UserRole::create([
                'user_id' => $user_id,
                'role_id' => Role::SELLER_ROLE_ID
            ]);
        }
    }
}
