<?php


namespace AppTests\Unit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use TestCase;

class ControllerTest extends TestCase
{
    /**
     * Teste para retornar parametros da request inicial recebida pelo Controller.
     *
     * @return void
     */
    public function testObterParametrosController()
    {
        $payloadArray = ['data' => 'Dummy data', 'message' => 'Dummy message'];

        $request = new Request([], $payloadArray);
        $request->setMethod('POST');

        $controller = new Controller($request);
        $controllerParams = $controller->getParams();

        $this->assertIsArray($controllerParams);
        $this->assertArrayHasKey('data', $controllerParams);
        $this->assertArrayHasKey('message', $controllerParams);
    }

    /**
     * Teste para retornar parametros da request inicial recebida pelo Controller.
     *
     * @return void
     */
    public function testObterCredenciaisController()
    {
        $payloadArray = ['email' => 'user@example.com', 'password' => '12345'];

        $request = new Request([], $payloadArray);
        $request->setMethod('POST');

        $controller = new Controller($request);
        $controllerCredentials = $controller->getCredentials();

        $this->assertIsArray($controllerCredentials);
        $this->assertArrayHasKey('email', $controllerCredentials);
        $this->assertArrayHasKey('password', $controllerCredentials);
    }
}
