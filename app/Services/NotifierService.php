<?php


namespace App\Services;


use Illuminate\Support\Facades\Http;

class NotifierService implements IExternalServiceResponse
{

    const SUCCESS = 'Success';

    public function sendNotification(){
        try{
            $response = Http::get(config('externalAPI.url_authorizing_service'));
        } catch(\Exception $e){
            return $this->createResponse(
                false,
                '',
                [ 'notificationService' => config('notifierServiceMessages.service_not_available') ]);
        }
        $responseContent = $response->json();

        $status = $responseContent && $responseContent['message'] && $responseContent['message'] === self::SUCCESS;
        $message = $status ? config('notifierServiceMessages.notification_send_success') : '';
        $errors = $status ? [] : [ 'notificationService' => config('notifierServiceMessages.notification_send_failure') ];

        return $this->createResponse($status, $message, $errors);
    }

    public function createResponse($status, $message, $errors = []): ExternalServiceResponse
    {
        return new ExternalServiceResponse($status, $message, $errors);
    }
}
