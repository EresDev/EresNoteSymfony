<?php

namespace App\Domain\Service\Responder;

use App\Domain\Service\Factory\HttpResponseFactory;
use App\Domain\Service\ValueObject\HttpResponse;

class DeleteNoteResponder implements Responder
{
    private $httpResponseFactory;

    public function __construct(HttpResponseFactory $httpResponseFactory)
    {
        $this->httpResponseFactory = $httpResponseFactory;
    }

    public function prepare($entityExistedAndDeleted): HttpResponse
    {
        return $this->httpResponseFactory->create(
            200,
            'success.delete.note.responder'
        );
    }
}
