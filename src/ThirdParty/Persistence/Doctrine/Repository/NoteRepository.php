<?php
namespace App\ThirdParty\Persistence\Doctrine\Repository;

use App\Domain\Entity\Note;
use App\Domain\Repository\NoteRepositoryInterface;

class NoteRepository extends AbstractRepository implements NoteRepositoryInterface
{
    protected $entityClass = Note::class;
}
