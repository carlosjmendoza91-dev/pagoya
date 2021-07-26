<?php


namespace App\Services;


class ExternalServiceResponse
{
    protected $status;
    protected $message = '';
    protected $errors = [];

    public function __construct($status, $message, $errors = []){
        $this->status = $status;
        $this->message = $message;
        $this->errors = $errors;
    }

    public function getStatus(){
        return $this->status;
    }

    public function getMessage(){
        return $this->message;
    }

    public function getErrors(){
        return $this->errors;
    }

    public function setStatus($status){
        $this->status = $status;
    }

    public function setMessage($message){
        $this->message = $message;
    }

    public function setErrors($errors){
        $this->errors = $errors;
    }

    public function toArray() {
        return get_object_vars($this);
    }
}
