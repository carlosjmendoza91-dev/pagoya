<?php


namespace App\Repositories\User;


interface IUserRepository {

    public function create(Array $userData);

    public function verifyPassword(Array $userLogin);

    public function getType(int $id);

    public function getBalance(int $id);
}
