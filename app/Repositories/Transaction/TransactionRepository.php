<?php


namespace App\Repositories\Transaction;

use App\Models\Transaction;
use App\Repositories\User\IUserRepository;
use App\Http\Helpers\DocumentTypeChecker;
use Illuminate\Auth\Access\AuthorizationException;

class TransactionRepository implements ITransactionRepository
{
    private $user;

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
        return $this->saveTransaction($transactionData);
    }

    private function saveTransaction($transactionData){
        $transactionResult = $this->user->updateBalances($transactionData['payer'], $transactionData['payee'], $transactionData['value']);
        $newTransference = new Transaction($transactionData);
        $newTransference->save();
        return $transactionResult;
    }

    private function checkUserType(int $id)
    {
        $user = $this->user->getType($id);
        if($user === DocumentTypeChecker::PJ_DOCUMENT_TYPE)
            throw new AuthorizationException(config('transactionMessages.user_type_not_allowed'));
    }

    private function checkUserBalance(int $id, float $amount)
    {
        $balance = $this->user->getBalance($id);
        if(round($balance, 2) < round($amount, 2))
            throw new \Exception(config('transactionMessages.user_no_funds_available'));
    }

}
