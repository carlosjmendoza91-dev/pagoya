<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Requests\Authentication\LoginRequest;
use App\Http\Controllers\Requests\Authentication\SignUpRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Repositories\User\IUserRepository;

class AuthController extends Controller
{
    const SIGNUP_SUCCESS = 'User was created successfully';
    const VERIFY_CREDENTIALS = 'Please, verify your access credentials';

    protected $user = null;

    public function __construct(IUserRepository $IUserRepository)
    {
        $this->user = $IUserRepository;
    }

    public function signup(SignUpRequest $signUpRequest)
    {
        $newUser = $this->user->create($signUpRequest->getParams());
        return $this->returnResponse([], 200, self::SIGNUP_SUCCESS);
    }

    public function login(LoginRequest $loginRequest)
    {
        if (! $token = Auth::attempt($loginRequest->getCredentials()))
            return $this->returnResponse([], 401, self::VERIFY_CREDENTIALS);

        return $this->returnResponse([
            'token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => null
        ], 200);
    }
}
