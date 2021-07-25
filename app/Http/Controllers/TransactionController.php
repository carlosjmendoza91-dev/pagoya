<?php


namespace App\Http\Controllers;


use App\Http\Controllers\Requests\Transaction\TransactionRequest;
use App\Repositories\Transaction\ITransactionRepository;
use Illuminate\Auth\Access\AuthorizationException;

class TransactionController extends Controller
{
    protected $transaction = null;

    public function __construct(ITransactionRepository $ITransactionRepository)
    {
        $this->transaction = $ITransactionRepository;
        $this->middleware('auth:api');
    }

    public function store(TransactionRequest $transactionRequest)
    {
        $transactionRequestParams = $transactionRequest->getParams();
        $this->checkLoggedInUser($transactionRequestParams['payer']);
        $transactionResult = $this->transaction->create($transactionRequestParams);
        return $this->returnResponse([], 200, $transactionResult->getMessage(), $transactionResult->getErrors());
    }

    private function checkLoggedInUser(int $idPayer){
        if(auth()->user()->getAuthIdentifier() !== $idPayer)
            throw new AuthorizationException(config('authMessages.user_no_priviledges'));
        return true;
    }

}
