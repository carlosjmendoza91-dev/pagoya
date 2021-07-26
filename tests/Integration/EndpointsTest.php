<?php


namespace AppTests\Integration;


use App\Http\Controllers\AuthController;
use App\Http\Controllers\Requests\Authentication\LoginRequest;
use App\Http\Controllers\Requests\Authentication\SignUpRequest;
use App\Repositories\User\UserRepository;
use App\Services\AuthorizingService;
use App\Services\NotifierService;
use Symfony\Component\HttpFoundation\Request;
use TestCase;

class EndpointsTest extends TestCase
{

    /**
     * Teste para verificar o retorno do endpoint de SignUp.
     *
     * @return void
     */
    public function testeEndpointSignUp()
    {

        $parameters = [
            "full_name" => "Carlos Mendoza",
            "document" => "063.825.131-77",
            "email" => "carlosjmendoza147@gmail.com",
            "password" => "12345",
            "phone" => "27999449153",
            "balance" => 100
        ];

        $this->post("/api/user/signup", $parameters, []);
        $this->seeStatusCode(201);
        $this->seeJsonStructure(
            [
                'data',
                'message',
                'errors',
                'timestamp'
            ]
        );

    }

    /**
     * Teste para verificar o retorno do endpoint de Login.
     *
     * @return void
     */
    public function testeEndpointLogin()
    {

        $parameters = [
            "email" => "carlosjmendoza147@gmail.com",
            "password" => "12345",
        ];

        $this->post("/api/user/login", $parameters, []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure(
            [
                'data' => [
                    'token',
                    'token_type',
                    'expires_in'
                ],
                'message',
                'errors',
                'timestamp'
            ]
        );

    }

}
