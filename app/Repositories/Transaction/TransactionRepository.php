<?php


namespace App\Repositories\Transaction;

use App\Models\Transaction;

class TransactionRepository implements ITransactionRepository
{

    public function create(array $transactionData)
    {
        $newTransference = new Transaction($transactionData);
        $newTransference->save();
        return $newTransference->toArray();
    }

}
