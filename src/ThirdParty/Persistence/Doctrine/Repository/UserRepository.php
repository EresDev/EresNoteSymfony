<?php
namespace App\ThirdParty\Persistence\Doctrine\Repository;

use App\Domain\Entity\User;
use App\Domain\Repository\NoteRepositoryInterface;

class UserRepository extends AbstractRepository implements NoteRepositoryInterface
{
    protected $entityClass = User::class;
}

