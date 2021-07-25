<?php


namespace App\Services;

use Illuminate\Support\Facades\Http;

class AuthorizingService
{

    const AUTHORIZED = 'Autorizado';
    const SERVICE_NOT_AVAILABLE = 'O servico autenticador nao esta disponivel';

    public function getAuthorization(){
        try{
            $response = Http::get(config('externalAPI.url_notifier_service'));
            $responseContent = $response->json();
            if($responseContent && isset($responseContent['message']) && $responseContent['message'] === self::AUTHORIZED)
                return true;
        } catch(\Exception $e){
            throw new \Exception(self::SERVICE_NOT_AVAILABLE);
        }
        return false;
    }
}
