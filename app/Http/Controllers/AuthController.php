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

    public function __construct(IUserRepository $user)
    {
        $this->user = $user;
        $this->middleware('auth:api', ['except' => ['login','signup']]);
    }

    public function signup(SignUpRequest $signUpRequest)
    {
        $newUser = $this->user->create($signUpRequest->getParams());
        return $this->returnResponse($newUser, 200);
    }

    public function login(LoginRequest $loginRequest)
    {
        if (! $token = Auth::attempt($loginRequest->getCredentials()))
            return $this->returnResponse([], 401, 'Unauthorized');

        return $this->returnResponse([
            'token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => null
        ], 200);
    }

    /**
     * Get user details.
     *
     * @param  Request  $request
     */
    public function me()
    {
        return response()->json(auth()->user());
    }
}
