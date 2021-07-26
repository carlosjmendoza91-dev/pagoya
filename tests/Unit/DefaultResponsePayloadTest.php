<?php


namespace AppTests\Unit;

use App\Http\Helpers\ResponsePayload;
use TestCase;

class DefaultResponsePayloadTest extends TestCase
{

    /**
     * Teste para obter objeto DefaultResponsePayloadTest com Data e Timestamp.
     *
     * @return void
     */
    public function testRetornaDefaultResponsePayloadComDataETimestampComoArray()
    {
        $dataArray = [ 'data' => 'Dummy test'];

        $defaultResponse = new ResponsePayload($dataArray);
        $responseArray = $defaultResponse->toArray();

        $this->assertIsArray($responseArray);

        $this->assertArrayHasKey('data', $responseArray);
        $this->assertEquals($dataArray, $responseArray['data']);

        $this->assertArrayHasKey('timestamp', $responseArray);
        $this->assertEquals($responseArray['timestamp'], date('Y-m-d H:i:s'));
    }

    /**
     * Teste para obter objeto DefaultResponsePayloadTest com Data, Timestamp e Message.
     *
     * @return void
     */
    public function testRetornaDefaultResponsePayloadComDataTimestampEMessageComoArray()
    {
        $dataArray = [ 'data' => 'Dummy test'];
        $message = 'This is a dummy message';

        $defaultResponse = new ResponsePayload($dataArray, $message);
        $responseArray = $defaultResponse->toArray();

        $this->assertIsArray($responseArray);

        $this->assertArrayHasKey('data', $responseArray);
        $this->assertEquals($dataArray, $responseArray['data']);

        $this->assertArrayHasKey('message', $responseArray);
        $this->assertEquals($message, $responseArray['message']);

        $this->assertArrayHasKey('timestamp', $responseArray);
        $this->assertEquals($responseArray['timestamp'], date('Y-m-d H:i:s'));
    }

    /**
     * Teste para obter objeto DefaultResponsePayloadTest com Data, Timestamp, Message e Errors.
     *
     * @return void
     */
    public function testRetornaDefaultResponsePayloadCompletoComoArray()
    {
        $dataArray = [ 'data' => 'Dummy test'];
        $message = 'This is a dummy message';
        $errors = ['error1' => 'This is error1', 'error2' => 'This is error 2'];

        $defaultResponse = new ResponsePayload($dataArray, $message, $errors);
        $responseArray = $defaultResponse->toArray();

        $this->assertIsArray($responseArray);

        $this->assertArrayHasKey('data', $responseArray);
        $this->assertEquals($dataArray, $responseArray['data']);

        $this->assertArrayHasKey('message', $responseArray);
        $this->assertEquals($message, $responseArray['message']);

        $this->assertArrayHasKey('errors', $responseArray);
        $this->assertEquals($errors, $responseArray['errors']);

        $this->assertArrayHasKey('timestamp', $responseArray);
        $this->assertEquals($responseArray['timestamp'], date('Y-m-d H:i:s'));
    }
}
