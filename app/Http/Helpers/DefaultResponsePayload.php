<?php


namespace App\Http\Helpers;


class DefaultResponsePayload
{

    protected $data;
    protected $message;
    protected $errors;
    protected $timestamp;

    public function __construct($data, $message = '', $errors = [])
    {
        $this->data = $data;
        $this->message = $message;
        $this->errors = $errors;
        $this->timestamp = date('Y-m-d H:i:s');
    }

    public function toArray() {
        return get_object_vars($this);
    }

}
