<?php

namespace App\Domain\Service\Factory;

use App\Domain\Entity\AbstractEntity;
use App\Domain\Entity\Note;
use App\Domain\Entity\User;
use App\Domain\Repository\UserRepositoryInterface;

final class NoteFactory implements EntityFactoryInterface
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createFromParameters(array $parameters) : AbstractEntity
    {
        $note = new Note(
            $parameters['title'] ?? '',
            $parameters['content'] ?? '',
            new \DateTime(),
            $this->getUser($parameters['user'])
        );

        return $note;
    }

    private function getUser(int $userId) : User
    {
        return $this->userRepository->getById($userId);
    }
}
