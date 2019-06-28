<?php

namespace App\Domain\UseCase;

use App\Domain\Repository\EntityDeleter;
use App\Domain\Service\Responder\Responder;
use App\Domain\Service\ValueObject\HttpResponse;

class DeleteNoteUseCase implements RetrieveUseCase
{
    private $responder;
    private $entityDeleter;

    public function __construct(
        Responder $responder,
        EntityDeleter $entityDeleter
    ) {
        $this->responder = $responder;
        $this->entityDeleter = $entityDeleter;
    }

    public function execute($noteId): HttpResponse
    {
        // TODO: delete note only if the user owns the note
        $note = $this->entityDeleter->delete($noteId);

        return $this->responder->prepare($note);
    }
}
