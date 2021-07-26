<?php

namespace AppTests\Integration;


use App\Repositories\User\UserRepository;
use App\Services\AuthorizingService;
use App\Services\NotifierService;
use Laravel\Lumen\Testing\DatabaseTransactions;
use TestCase;

class UserRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Teste para criar um novo usuario PF.
     *
     * @return void
     */
    public function testeRepositorioCriaNovoUsuarioPF()
    {

        $authorizingService = new AuthorizingService();
        $notifierService = new NotifierService();

        $userRepository = new UserRepository($authorizingService, $notifierService);

        $userData = [
            "full_name" => "Carlos Mendoza",
            "document" => "063.913.247-27",
            "email" => "carlosjmendoza@gmail.com",
            "password" => "12345",
            "phone" => "27999449153",
            "balance" => 150.75
        ];

        $userPF = $userRepository->create($userData);
        $this->assertIsArray($userPF);
        $this->assertArrayHasKey('full_name', $userPF);
        $this->assertArrayHasKey('document', $userPF);
        $this->assertArrayHasKey('email', $userPF);
        $this->assertArrayHasKey('phone', $userPF);
        $this->assertArrayHasKey('balance', $userPF);

    }

    /**
     * Teste para criar um novo usuario PJ.
     *
     * @return void
     */
    public function testeRepositorioCriaNovoUsuarioPJ()
    {

        $authorizingService = new AuthorizingService();
        $notifierService = new NotifierService();

        $userRepository = new UserRepository($authorizingService, $notifierService);

        $userData = [
            "full_name" => "Carlos Mendoza Empresa",
            "document" => "99.962.217/0001-40",
            "email" => "carlosjmendozairidescent2@gmail.com",
            "password" => "67890",
            "phone" => "27999449153",
            "balance" => 200
        ];

        $userPJ = $userRepository->create($userData);
        $this->assertIsArray($userPJ);
        $this->assertArrayHasKey('full_name', $userPJ);
        $this->assertArrayHasKey('document', $userPJ);
        $this->assertArrayHasKey('email', $userPJ);
        $this->assertArrayHasKey('phone', $userPJ);
        $this->assertArrayHasKey('balance', $userPJ);

    }

    /**
     * Teste para verificar tipo de usuario pessoa fisica.
     *
     * @return void
     */
    public function testeRepositorioObtemTipoUsuarioPF()
    {

        $authorizingService = new AuthorizingService();
        $notifierService = new NotifierService();

        $userRepository = new UserRepository($authorizingService, $notifierService);

        $userData = [
            "full_name" => "Carlos Mendoza",
            "document" => "063.913.247-11",
            "email" => "carlosjmendoza796454@gmail.com",
            "password" => "12345",
            "phone" => "27999449153",
            "balance" => 150.75
        ];

        $userPF = $userRepository->create($userData);

        $this->assertEquals(1, $userRepository->getType($userPF['id']));

    }

    /**
     * Teste para verificar tipo de usuario pessoa juridica.
     *
     * @return void
     */
    public function testeRepositorioObtemTipoUsuarioPJ()
    {

        $authorizingService = new AuthorizingService();
        $notifierService = new NotifierService();

        $userRepository = new UserRepository($authorizingService, $notifierService);

        $userData = [
            "full_name" => "Carlos Mendoza Empresa",
            "document" => "99.962.217/0001-55",
            "email" => "carlosjmendozairidescent39657@gmail.com",
            "password" => "67890",
            "phone" => "27999449153",
            "balance" => 200
        ];

        $userPJ = $userRepository->create($userData);

        $this->assertEquals(0, $userRepository->getType($userPJ['id']));

    }

    /**
     * Teste para obter balance atual de usuario.
     *
     * @return void
     */
    public function testeRepositorioObterBalance()
    {

        $authorizingService = new AuthorizingService();
        $notifierService = new NotifierService();

        $userRepository = new UserRepository($authorizingService, $notifierService);

        $userData = [
            "full_name" => "Carlos Mendoza",
            "document" => "063.913.247-29",
            "email" => "carlosjmendoza1144@gmail.com",
            "password" => "12345",
            "phone" => "27999449153",
            "balance" => 20
        ];

        $userPF = $userRepository->create($userData);

        $this->assertEquals(20, $userRepository->getBalance($userPF['id']));

    }

    /**
     * Teste para verificar a transferencia entre carteiras de usuario.
     *
     * @return void
     */
    public function testeRepositorioAtualizarBalances()
    {

        $authorizingService = new AuthorizingService();
        $notifierService = new NotifierService();

        $userRepository = new UserRepository($authorizingService, $notifierService);

        $userDataPF = [
            "full_name" => "Carlos Mendoza",
            "document" => "874.953.111-30",
            "email" => "carlosjmendoza9854214@gmail.com",
            "password" => "12345",
            "phone" => "27999449153",
            "balance" => 100
        ];

        $userPF = $userRepository->create($userDataPF);

        $userDataPJ = [
            "full_name" => "Carlos Mendoza Empresa",
            "document" => "99.296.217/0001-42",
            "email" => "carlosjmendozairidescent741258@gmail.com",
            "password" => "67890",
            "phone" => "27999449153",
            "balance" => 200
        ];

        $userPJ = $userRepository->create($userDataPJ);

        $userRepository->updateBalances($userPF['id'], $userPJ['id'], 50);

        $this->assertEquals(50, $userRepository->getBalance($userPF['id']));
        $this->assertEquals(250, $userRepository->getBalance($userPJ['id']));

    }

}
