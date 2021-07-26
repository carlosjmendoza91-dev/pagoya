<?php


namespace App\Http\Controllers\Requests\Authentication;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SignUpRequest extends Controller
{
    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function __construct(Request $request)
    {
        $this->validate(
            $request, [
                'full_name' => 'required|string',
                'document' => array(
                    'required',
                    'string',
                    'unique:users',
                    'regex:/(^\d{3}\.\d{3}\.\d{3}\-\d{2}$)|(^\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2}$)/'
                ),
                'email' => 'required|email|unique:users',
                'password' => 'required|min:5',
                'phone' => 'string',
                'balance' => 'numeric'
            ]
        );

        parent::__construct($request);
    }
}
