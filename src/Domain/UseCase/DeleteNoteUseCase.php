<?php

namespace App\Domain\UseCase;

use App\Domain\Repository\EntityDeleter;
use App\Domain\Service\Responder\Responder;
use App\Domain\Service\Security\Ownership;
use App\Domain\Service\ValueObject\HttpResponse;

class DeleteNoteUseCase implements RetrieveUseCase
{
    private $responder;
    private $ownership;
    private $entityDeleter;

    public function __construct(
        Responder $responder,
        Ownership $ownership,
        EntityDeleter $entityDeleter
    ) {
        $this->responder = $responder;
        $this->ownership = $ownership;
        $this->entityDeleter = $entityDeleter;
    }

    public function execute(int $noteId): HttpResponse
    {
        $this->ownership->check($noteId);

        $note = $this->entityDeleter->delete($noteId);

        return $this->responder->prepare($note);
    }
}
