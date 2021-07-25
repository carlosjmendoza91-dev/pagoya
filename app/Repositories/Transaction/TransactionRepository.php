<?php


namespace App\Repositories\Transaction;

use App\Models\Transaction;
use App\Repositories\User\IUserRepository;
use App\Http\Helpers\DocumentTypeChecker;

class TransactionRepository implements ITransactionRepository
{
    private $user = null;

    public function __construct(IUserRepository $IUserRepository)
    {
        $this->user = $IUserRepository;
    }

    /**
     * @throws \Exception
     */
    public function create(array $transactionData)
    {
        $this->checkUserType($transactionData['payer']);
        $this->checkUserBalance($transactionData['payer'], $transactionData['value']);

        $newTransference = new Transaction($transactionData);
        $newTransference->save();
        return $newTransference->toArray();
    }

    private function checkUserType(int $id)
    {
        $user = $this->user->getType($id);
        if($user === DocumentTypeChecker::PJ_DOCUMENT_TYPE)
            throw new \Exception('Usuario CPNJ nao pode enviar dinheiro');
    }

    private function checkUserBalance(int $id, float $amount)
    {
        $balance = $this->user->getBalance($id);
        if(round($balance, 2) < round($amount, 2))
            throw new \Exception('Usuario nao possui dinheiro para enviar');
    }

}
