<?php


namespace App\Repositories\User;


interface IUserRepository {

    public function create(Array $userData);

    public function verifyPassword(Array $userLogin);

    public function checkIfUserExists(string $email);
}
