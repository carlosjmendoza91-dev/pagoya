<?php


namespace AppTests\Integration;


use App\Services\AuthorizingService;
use TestCase;

class AuthorizingServiceTest extends TestCase
{

    /**
     * Teste para obter resultado da chamada ao servico autorizador externo.
     *
     * @return void
     */
    public function testeObterAutorizacao()
    {
        $authorizingService = new AuthorizingService();

        $this->assertEquals(true, $authorizingService->getAuthorization());
    }

}
