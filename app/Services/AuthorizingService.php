<?php


namespace App\Services;

use Illuminate\Support\Facades\Http;

class AuthorizingService implements IExternalServiceResponse
{

    const AUTHORIZED = 'Autorizado';

    public function getAuthorization(){
        try{
            $response = Http::get(config('externalAPI.url_authorizing_service'));
            $responseContent = $response->json();

            if($responseContent && isset($responseContent['message']) && $responseContent['message'] === self::AUTHORIZED){
                return true;
            }
            throw new \Exception(config('authorizingServiceMessages.transaction_not_authorized'));

        } catch(\Exception $e){
            throw new \Exception(config('authorizingServiceMessages.service_not_available'));
        }

    }

    public function createResponse($status, $message, $errors = []): ExternalServiceResponse
    {
        // TODO: Implement createResponse() method.
    }
}
