<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Requests\Authentication\LoginRequest;
use App\Http\Controllers\Requests\Authentication\SignUpRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Repositories\User\IUserRepository;

class AuthController extends Controller
{

    protected $user = null;

    public function __construct(IUserRepository $IUserRepository)
    {
        $this->user = $IUserRepository;
    }

    public function signup(SignUpRequest $signUpRequest)
    {
        $newUser = $this->user->create($signUpRequest->getParams());
        return $this->returnResponse([], 201, config('authMessages.signup_success'));
    }

    public function login(LoginRequest $loginRequest)
    {
        if (! $token = Auth::attempt($loginRequest->getCredentials()))
            return $this->returnResponse([], 401, config('authMessages.verify_credentials'));

        return $this->returnResponse([
            'token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => null
        ], 200, config('authMessages.login_success'));
    }

    public function logout(Request $request){
        Auth::logout();
        return $this->returnResponse([], 200, config('authMessages.logout_success'));
    }
}
