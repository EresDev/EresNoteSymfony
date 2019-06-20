<?php

namespace App\Domain\Service\Responder;

use App\Domain\Entity\Entity;
use App\Domain\Service\Factory\HttpResponseFactory;
use App\Domain\Service\Translator;
use App\Domain\Service\ValueObject\HttpResponse;

class NoteGetterResponder implements Responder
{
    private $translator;
    private $httpResponseFactory;

    public function __construct(
        Translator $translator,
        HttpResponseFactory  $httpResponseFactory
    ) {
        $this->translator = $translator;
        $this->httpResponseFactory = $httpResponseFactory;
    }

    public function prepare(?Entity $entity): HttpResponse
    {
        if ($entity != null) {
            return $this->getResponse(200, $entity);
        }

        return $this->getResponse(
            404,
            $this->translator->translate('not.found.resource.getter.responder')
        );
    }

    protected function getResponse(int $statusCode, $data): HttpResponse
    {
        $response = $this->httpResponseFactory->create($statusCode, $data);
        return $response;
    }
}
