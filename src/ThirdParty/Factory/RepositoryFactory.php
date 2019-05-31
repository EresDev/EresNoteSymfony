<?php

namespace App\ThirdParty\Factory;

use App\Domain\Entity\AbstractEntity;
use App\Domain\Entity\Note;
use App\Domain\Entity\User;
use App\Domain\Repository\RepositoryInterface;
use App\Domain\Service\Factory\RepositoryFactoryInterface;
use App\ThirdParty\Persistence\Doctrine\Repository\NoteRepositoryImpl;
use App\ThirdParty\Persistence\Doctrine\Repository\UserRepositoryImpl;
use Doctrine\ORM\EntityManagerInterface;

class RepositoryFactory implements RepositoryFactoryInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function create(AbstractEntity $entity): RepositoryInterface
    {
        $class = get_class($entity);

        switch ($class) {
            case Note::class:
                return new NoteRepositoryImpl($this->entityManager);
            case User::class:
                return new UserRepositoryImpl($this->entityManager);
        }

        throw new \UnexpectedValueException(
          'Unable to create repository for '. $class
        );
    }
}
