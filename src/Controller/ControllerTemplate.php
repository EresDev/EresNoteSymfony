<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

abstract class ControllerTemplate
{
    protected $response;

    public function __construct()
    {
        $this->response = new JsonResponse();
    }

    public function handleRequest() : JsonResponse {
        $this->prepareResponse();
        return $this->response;
    }

    protected abstract function prepareResponse() : void;
}
