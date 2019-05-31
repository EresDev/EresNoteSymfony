<?php

namespace App\ThirdParty\Persistence\Doctrine\Repository;

use App\Domain\Entity\Note;
use App\Domain\Repository\NoteRepository;

class NoteRepositoryImpl extends AbstractRepository implements NoteRepository
{
    protected $entityClass = Note::class;
}
