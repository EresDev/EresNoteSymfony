<?php

namespace App\Domain\Service\Responder;

use App\Domain\Entity\Entity;
use App\Domain\Service\Translator;
use App\Domain\Service\ValueObject\HttpResponse;

class DeleteNoteResponder implements Responder
{
    private $translator;

    public function __construct(Translator $translator)
    {
        $this->translator = $translator;
    }

    public function prepare(?Entity $entity): HttpResponse
    {
        if (is_null($entity)) {

            return HttpResponse::fromString(
                404,
                $this->translator->translate('fail.delete.note.notFound.responder')
            );
        }

        return HttpResponse::fromString(
            200,
            $this->translator->translate('success.delete.note.responder')
        );
    }
}
