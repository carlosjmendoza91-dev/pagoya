<?php


namespace App\Http\Controllers;


use App\Http\Controllers\Requests\Authentication\LoginRequest;
use App\Http\Controllers\Requests\User\SignUpRequest;
use App\Http\Helpers\DefaultResponsePayload;
use App\Models\User;
use App\Repositories\User\IUserRepository;

class UserController extends Controller
{

    protected $user = null;

    public function __construct(IUserRepository $user)
    {
        $this->user = $user;
    }

    public function create(SignUpRequest $createUserRequest)
    {
        $newUser = $this->user->create($createUserRequest->getParams()->toArray());
        $responsePayload = new DefaultResponsePayload($newUser, '');
        return response()->json($responsePayload->toArray(), 201);
    }

    public function authenticate(LoginRequest $loginRequest){
        $userAuthenticated = $this->user->verifyPassword($loginRequest->getParams()->toArray());
        $responsePayload = new DefaultResponsePayload($userAuthenticated, '');
        return response()->json($responsePayload->toArray(), 200);
    }


}
