<?php

namespace App\Domain\UseCase;

use App\Domain\Repository\EntitySingleGetter;
use App\Domain\Service\Responder\Responder;
use App\Domain\Service\ValueObject\HttpResponse;

class GetNoteUseCase implements RetrieveUseCase
{
    private $responder;
    private $entitySingleGetter;

    public function __construct(
        Responder $responder,
        EntitySingleGetter $entitySingleGetter
    ) {
        $this->responder = $responder;
        $this->entitySingleGetter = $entitySingleGetter;
    }

    public function execute(int $entityId) : HttpResponse
    {
        $entity = $this->entitySingleGetter->getById($entityId);

        return $this->responder->prepare($entity);
    }
}
