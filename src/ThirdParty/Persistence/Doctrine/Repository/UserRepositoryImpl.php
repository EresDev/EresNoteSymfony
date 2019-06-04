<?php

namespace App\ThirdParty\Persistence\Doctrine\Repository;

use App\Domain\Entity\User;
use App\Domain\Repository\UserRepository;

class UserRepositoryImpl extends AbstractRepository implements UserRepository
{
    public function getEntityClass(): string
    {
        return User::class;
    }
}

