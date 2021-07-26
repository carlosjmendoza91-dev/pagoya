<?php


namespace AppTests\Integration;


use App\Services\NotifierService;
use TestCase;

class NotifierServiceTest extends TestCase
{

    /**
     * Teste para obter resultado da chamada ao servico de envio de notificacoes.
     *
     * @return void
     */
    public function testeEnviarNotificacao()
    {
        $notifierService = new NotifierService();

        $notifierResponser = $notifierService->sendNotification();

        $this->assertObjectHasAttribute('status', $notifierResponser);
        $this->assertObjectHasAttribute('message', $notifierResponser);
        $this->assertObjectHasAttribute('errors', $notifierResponser);
    }

}
