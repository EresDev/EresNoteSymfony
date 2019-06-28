<?php

namespace App\Domain\UseCase;

use App\Domain\Repository\EntityDeleter;
use App\Domain\Service\Responder\DeleteResponder;
use App\Domain\Service\ValueObject\HttpResponse;

class DeleteNoteUseCase implements RetrieveUseCase
{
    private $deleteResponder;
    private $entityDeleter;

    public function __construct(
        DeleteResponder $deleteResponder,
        EntityDeleter $entityDeleter
    ) {
        $this->deleteResponder = $deleteResponder;
        $this->entityDeleter = $entityDeleter;
    }

    public function execute($noteId): HttpResponse
    {
        // TODO: delete note only if the user owns the note
        $this->entityDeleter->delete($noteId);

        return $this->deleteResponder->prepare();
    }
}
