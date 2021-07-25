<?php


namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements IUserRepository
{

    public function create(Array $userData)
    {
        $newUser = new User($userData);
        $newUser->save();
        return $newUser->toArray();
    }

    public function verifyPassword(Array $userLogin)
    {
        $currentUser = $this->getUserByEmail($userLogin['email']);
        if(Hash::check($userLogin['password'], $currentUser->password))
            return $currentUser;
        return null;
    }

    private function getUserByEmail(string $email){
        return User::where('email', $email)->first();
    }


    public function getType(int $id)
    {
        $user = User::where('id', $id)->first();
        return $user->type;
    }

    public function getBalance(int $id)
    {
        $user = User::where('id', $id)->first();
        return $user->balance;
    }
}
