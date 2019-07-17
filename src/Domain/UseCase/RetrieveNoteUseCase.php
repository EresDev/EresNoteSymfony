<?php

namespace App\Domain\UseCase;

use App\Domain\Repository\EntitySingleGetter;
use App\Domain\Service\Responder\Responder;
use App\Domain\Service\Security\Ownership;
use App\Domain\Service\ValueObject\HttpResponse;

class RetrieveNoteUseCase implements RetrieveUseCase
{
    private $responder;
    private $ownership;
    private $entitySingleGetter;

    public function __construct(
        Responder $responder,
        Ownership $ownership,
        EntitySingleGetter $entitySingleGetter
    ) {
        $this->responder = $responder;
        $this->ownership = $ownership;
        $this->entitySingleGetter = $entitySingleGetter;
    }

    public function execute(int $entityId) : HttpResponse
    {
        $this->ownership->check($entityId);

        $entity = $this->entitySingleGetter->getById($entityId);

        return $this->responder->prepare($entity);
    }
}
