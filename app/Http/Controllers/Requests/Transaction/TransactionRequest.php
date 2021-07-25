<?php


namespace App\Http\Controllers\Requests\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionRequest extends Controller
{
    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function __construct(Request $request)
    {
        $this->validate(
            $request, [
                'value' => 'required|numeric|min:0.01',
                'payer' => 'required|numeric|exists:users,id',
                'payee' => 'required|numeric|exists:users,id'
            ]
        );

        parent::__construct($request);
    }
}
