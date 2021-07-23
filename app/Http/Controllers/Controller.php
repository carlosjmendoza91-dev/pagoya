<?php

namespace App\Http\Controllers;

use App\Http\Helpers\DefaultResponsePayload;
use Illuminate\Http\Request;
use App\Http\Controllers\Requests\ApiRequest;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController implements ApiRequest
{
    protected $service;
    protected $params;
    public $request;

    public function __construct(Request $request)
    {
        $this->params = $request->all();
        $this->request = $request;
    }

    /**
     * Return the Request Object
     *
     * @return \Illuminate\Http\Request
     */
    public function getParams(): Request
    {
        return $this->request->replace($this->params);
    }

    public function getCredentials() {
        if($this->params['email'] && $this->params['password']){
            return [
                'email' => $this->params['email'],
                'password' => $this->params['password']
            ];
        }

    }

    public function returnResponse($data, $status, $message = '', $errors = []){
        $responsePayload = new DefaultResponsePayload($data, $message, $errors);
        return response()->json($responsePayload->toArray(), $status);
    }

}
