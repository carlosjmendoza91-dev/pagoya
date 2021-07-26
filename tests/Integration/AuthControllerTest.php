<?php


namespace AppTests\Integration;


use App\Http\Controllers\AuthController;
use App\Http\Controllers\Requests\Authentication\LoginRequest;
use App\Http\Controllers\Requests\Authentication\SignUpRequest;
use App\Repositories\User\UserRepository;
use App\Services\AuthorizingService;
use App\Services\NotifierService;
use Illuminate\Http\Request;
use Laravel\Lumen\Testing\DatabaseTransactions;
use TestCase;

class AuthControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Teste para cadastrar um usuario.
     *
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function testeMetodoSignUp()
    {

        $userData = [
            "full_name" => "Carlos Mendoza",
            "document" => "063.913.247-99",
            "email" => "carlosjmendoza007@gmail.com",
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

        $response = $authController->signup($signUpRequest);

        $this->assertEquals(201, $response->getStatusCode());

    }

    /**
     * Teste para fazer login com usuario.
     *
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function testeMetodoLogin()
    {

        $userData = [
            "full_name" => "Carlos Mendoza",
            "document" => "063.913.247-74",
            "email" => "carlosjmendoza998@gmail.com",
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

        $this->assertEquals(200, $response->getStatusCode());

    }

}
