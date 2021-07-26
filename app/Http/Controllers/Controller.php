<?php

namespace App\Http\Controllers;

use App\Http\Helpers\ResponsePayload;
use Illuminate\Http\Request;
use App\Http\Controllers\Requests\ApiRequest;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController implements ApiRequest
{
    protected $params;
    public $request;

    public function __construct(Request $request)
    {
        $this->params = $request->all();
        $this->request = $request;
    }

    public function getParams()
    {
        return $this->params;
    }

    public function getCredentials() {
        if($this->params['email'] && $this->params['password']){
            return [
                'email' => $this->params['email'],
                'password' => $this->params['password']
            ];
        }
        return [];
    }

    public function returnResponse($data, $status, $message = '', $errors = []){
        $responsePayload = new ResponsePayload($data, $message, $errors);
        return response()->json($responsePayload->toArray(), $status);
    }

}
