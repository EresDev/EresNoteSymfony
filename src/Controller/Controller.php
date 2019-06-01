<?php

namespace App\Controller;

use App\Domain\Service\ValueObject\HttpResponse;
use Symfony\Component\HttpFoundation\JsonResponse;

abstract class Controller
{
    public function handleRequest() : JsonResponse {
        $response = $this->getResponse();

        return new JsonResponse(
            $response->getContent(),
            $response->getStatusCode(),
            [],
            true
        );
    }

    abstract protected function getResponse() : HttpResponse;
}
