<?php


namespace AppTests\Unit;

use App\Http\Middleware\NormalizeRequestPayloadMiddleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\ParameterBag;
use TestCase;

class NormalizeRequestPayloadMiddlewareTest extends TestCase
{
    /**
     * Teste para retornar payload JSON da request em Array.
     *
     * @return void
     */
    public function testConverteRequestPayloadEmArray()
    {
        $payloadArray = ['data' => 'Dummy data', 'message' => 'Dummy message'];

        $request = new Request();
        $parameterBag = new ParameterBag($payloadArray);
        $request->setMethod('POST');
        $request->headers->set('Content-Type', 'application/json');
        $request->setJson($parameterBag);

        $middleware = new NormalizeRequestPayloadMiddleware();

        $middleware->handle($request, function ($req){
            $payloadReq = $req->all();
            $this->assertIsArray($payloadReq);
            $this->assertArrayHasKey('data', $payloadReq);
            $this->assertArrayHasKey('message', $payloadReq);
        });
    }
}
