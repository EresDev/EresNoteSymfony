<?php

namespace App\ThirdParty\Event\Listener\Symfony;

use App\Domain\Exception\HttpException;
use App\Domain\Service\Translator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

class ExceptionListener
{
    private $translator;

    public function __construct(Translator $translator)
    {
        $this->translator = $translator;
    }

    public function onKernelException(GetResponseForExceptionEvent $event) : void
    {
        $exception = $event->getException();
        $response = new JsonResponse();

        $response->setStatusCode(404);

        if ($exception instanceof HttpException) {
            $response->setStatusCode($exception->getHttpStatusCode());
        } else {
            $response->setStatusCode(JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }

        if (isset($_ENV['APP_ENV']) && $_ENV['APP_ENV'] == 'prod') {
            $errorMessage = $this->translator->translate($exception->getMessageForEndUser());
            $response->setContent($errorMessage);
        } else {
            $response->setContent($exception->getMessage());
        }

        $event->setResponse($response);
    }
}
