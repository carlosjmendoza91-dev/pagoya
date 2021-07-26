<?php


namespace AppTests\Integration;


use App\Repositories\Transaction\TransactionRepository;
use App\Repositories\User\UserRepository;
use App\Services\AuthorizingService;
use App\Services\NotifierService;
use TestCase;

class TransactionRepositoryTest extends TestCase
{

    /**
     * Teste para verificar a criacao de uma transaction.
     *
     * @return void
     */
    public function testeCriarTransaction()
    {

        $authorizingService = new AuthorizingService();
        $notifierService = new NotifierService();

        $userRepository = new UserRepository($authorizingService, $notifierService);

        $userDataPF = [
            "full_name" => "Carlos Mendoza",
            "document" => "852.147.963-30",
            "email" => "carlosjmendoza997@gmail.com",
            "password" => "12345",
            "phone" => "27999449153",
            "balance" => 100
        ];

        $userPF = $userRepository->create($userDataPF);

        $userDataPJ = [
            "full_name" => "Carlos Mendoza Empresa",
            "document" => "99.296.874/0001-42",
            "email" => "carlosjmendozairidescent9658@gmail.com",
            "password" => "67890",
            "phone" => "27999449153",
            "balance" => 200
        ];

        $userPJ = $userRepository->create($userDataPJ);

        $transactionRepository = new TransactionRepository($userRepository);

        $transactionCreated = $transactionRepository->create(['payer' => $userPF['id'], 'payee' => $userPJ['id'], 'value' => 70]);

        $this->assertObjectHasAttribute('status', $transactionCreated);
        $this->assertObjectHasAttribute('message', $transactionCreated);
        $this->assertObjectHasAttribute('errors', $transactionCreated);

    }

}
