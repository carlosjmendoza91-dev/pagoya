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

    /**
     * Teste para verificar o retorno do endpoint de Logout.
     *
     * @return void
     */
    public function testeEndpointLogout()
    {

        $userData = [
            "full_name" => "Carlos Mendoza",
            "document" => "963.852.741-00",
            "email" => "carlosjmendozateste2@gmail.com",
            "password" => "12345",
            "phone" => "27999449153",
            "balance" => 150.75
        ];

        $request = new Request();
        $request->initialize($userData);

        $signUpRequest = new SignUpRequest($request);

        $authorizingService = new AuthorizingService();
        $notifierService = new NotifierService();

        $userRepository = new UserRepository($authorizingService, $notifierService);

        $authController = new AuthController($userRepository);

        $authController->signup($signUpRequest);

        $userData = [
            "email" => "carlosjmendoza998@gmail.com",
            "password" => "12345",
        ];

        $request = new Request();
        $request->initialize($userData);

        $loginRequest = new LoginRequest($request);

        $authController = new AuthController($userRepository);

        $response = $authController->login($loginRequest);

        dd($response->getData());

        //$this->assertEquals(200, $response->getStatusCode());

    }


}
