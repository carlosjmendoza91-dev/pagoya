<?php


namespace App\Services;


interface IExternalServiceResponse
{
    public function createResponse($status, $message, $errors =[]): ExternalServiceResponse;
}
