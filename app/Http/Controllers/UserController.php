<?php


namespace App\Http\Controllers;


use App\Http\Controllers\Requests\User\UserRequest;
use App\Repositories\User\IUserRepository;
//use Illuminate\Http\Request;

class UserController extends Controller
{

    protected $user = null;

    public function __construct(IUserRepository $user)
    {
        $this->user = $user;
    }

    public function create(UserRequest $userRequest)
    {
        $newUser = $this->user->create($userRequest->getParams()->toArray());
        return response()->json($newUser, 201);
    }

}
