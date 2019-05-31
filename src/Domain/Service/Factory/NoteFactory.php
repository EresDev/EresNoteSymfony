<?php

namespace App\Domain\Service\Factory;

use App\Domain\Entity\AbstractEntity;
use App\Domain\Entity\Note;
use App\Domain\Entity\User;
use App\Domain\Repository\UserRepository;

final class NoteFactory implements EntityFactory
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
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
