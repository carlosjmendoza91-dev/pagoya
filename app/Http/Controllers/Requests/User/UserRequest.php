<?php


namespace App\Http\Controllers\Requests\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserRequest extends Controller
{
    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function __construct(Request $request)
    {
        $this->validate(
            $request, [
                'full_name' => 'required|string',
                'document' => 'required|string|unique:users',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:5',
                'phone' => 'string'
            ]
        );

        parent::__construct($request);
    }
}
