<?php

namespace App\Domain\Service\Responder;

use App\Domain\Entity\Entity;
use App\Domain\Service\Translator;
use App\Domain\Service\ValueObject\HttpResponse;

class RetrieveNoteResponder implements Responder
{
    private $translator;

    public function __construct(
        Translator $translator
    ) {
        $this->translator = $translator;
    }

    public function prepare(?Entity $entity): HttpResponse
    {
        if (is_null($entity)) {

            return HttpResponse::fromString(
                404,
                $this->translator->translate('not.found.resource.getter.responder')
            );
        }

        return HttpResponse::fromObject(200, $entity);
    }
}
