<?php


namespace App\Http\Controllers;


use App\Http\Controllers\Requests\Transaction\TransactionRequest;
use App\Repositories\Transaction\ITransactionRepository;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    protected $transaction = null;

    public function __construct(ITransactionRepository $ITransactionRepository)
    {
        $this->transaction = $ITransactionRepository;
        //$this->middleware('auth:api', ['except' => ['create']]);
        //$this->middleware('auth:api');
    }

    public function store(TransactionRequest $transactionRequest)
    {
        $newTransaction = $this->transaction->create($transactionRequest->getParams());
        return $this->returnResponse($newTransaction, 200);
    }
}
