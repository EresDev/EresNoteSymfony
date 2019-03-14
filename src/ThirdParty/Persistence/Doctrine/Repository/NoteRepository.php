<?php


namespace EresNote\ThirdParty\Persistence\Doctrine\Repository;

use EresNote\Domain\Entity\Note;
use EresNote\Domain\Repository\NoteRepositoryInterface;

class NoteRepository extends AbstractRepository implements NoteRepositoryInterface
{
    protected $entityClass = Note::class;
}
