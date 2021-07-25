<?php


namespace App\Services;


use Illuminate\Support\Facades\Http;

class NotifierService
{

    const SUCCESS = 'Success';
    const USER_NOTIFIED = 'A notificacao foi enviada com sucesso';
    const USER_NOT_NOTIFIED = 'Nao foi possivel enviar a notificacao';

    public function sendNotification(){
        try{
            $response = Http::get(config('externalAPI.url_authorizing_service'));
        } catch(\Exception $e){
           return self::USER_NOT_NOTIFIED;
        }
        $responseContent = $response->json();
        return ($responseContent && $responseContent['message'] && $responseContent['message'] === self::SUCCESS) ?  self::USER_NOTIFIED : self::USER_NOT_NOTIFIED;
    }
}
