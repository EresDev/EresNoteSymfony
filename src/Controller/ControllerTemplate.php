<?php

namespace App\Controller;

use App\Domain\Service\Http\Response;

abstract class ControllerTemplate
{
    public function handleRequest() : Response
    {
        return $this->getResponse();
    }

    protected abstract function getResponse() : Response;
}
