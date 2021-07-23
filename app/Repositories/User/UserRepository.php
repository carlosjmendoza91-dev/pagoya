<?php


namespace App\Repositories\User;

use App\Models\User;

class UserRepository implements IUserRepository
{

    public function create(Array $userData)
    {
        $newUser = new User($userData);
        $newUser->save();
        return $newUser->toArray();
    }
}
