<?php

namespace App\ThirdParty\Event\Listener\Symfony;

use App\Domain\Exception\HttpException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ExceptionListener
{
    public function onKernelException(GetResponseForExceptionEvent $event) : void
    {
        $exception = $event->getException();
        $response = new JsonResponse();
        $response->setContent($exception->getMessage());
        $response->setStatusCode(404);

        if ($exception instanceof HttpException) {
            $response->setStatusCode($exception->getHttpStatusCode());
        } else {
            $response->setStatusCode(JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }

        $event->setResponse($response);
    }
}
