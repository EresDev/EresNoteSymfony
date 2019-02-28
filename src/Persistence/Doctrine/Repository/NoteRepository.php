<?php


namespace EresNote\Persistence\Doctrine\Repository;


use EresNote\Domain\Entity\AbstractEntity;
use EresNote\Domain\Repository\NoteRepositoryInterface;

class NoteRepository extends AbstractRepository implements NoteRepositoryInterface
{
    protected $entityClass = 'EresNote\Domain\Entity\Note';
}
