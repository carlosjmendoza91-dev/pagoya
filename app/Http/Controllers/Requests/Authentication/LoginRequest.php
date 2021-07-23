<?php


namespace App\Http\Controllers\Requests\Authentication;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginRequest extends Controller
{
    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function __construct(Request $request)
    {
        $this->validate(
            $request, [
                'email' => 'required|email|exists:users,email',
                'password' => 'required|string'
            ]
        );

        parent::__construct($request);
    }
}
