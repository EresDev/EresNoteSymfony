<?php

namespace App\ThirdParty\Persistence\Doctrine\Repository;

use App\Domain\Entity\Note;
use App\Domain\Entity\User;
use App\Domain\Repository\NoteRepository;

class NoteRepositoryImpl extends AbstractRepository implements NoteRepository
{
    public function getEntityClass(): string
    {
        return Note::class;
    }

    public function getOwner(int $entityId): ?User
    {
        $note = $this->entityManager->find($this->getEntityClass(), $entityId);

        return $note == null ? null : $note->getUser();
    }
}
