<?php


namespace App\Http\Controllers;


use App\Repositories\User\IUserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{

    protected $user = null;

    public function __construct(IUserRepository $user)
    {
        $this->user = $user;
    }

    public function create(Request $request)
    {
        $newUser = $this->user->create($request->all());
        return response()->json($newUser, 201);
    }

}
