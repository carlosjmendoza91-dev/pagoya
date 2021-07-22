<?php


namespace App\Http\Controllers\Requests\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserRequest extends Controller
{
    public function __construct(Request $request)
    {
        $this->validate(
            $request, [
                'full_name' => 'required',
                'document' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:5'
            ]
        );

        parent::__construct($request);
    }
}
