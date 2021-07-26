<?php


namespace App\Repositories\User;


interface IUserRepository {

    public function create(Array $userData);

    public function getType(int $id);

    public function getBalance(int $id);

    public function updateBalances(int $idPayer, int $idPayee, float $amount);
}
