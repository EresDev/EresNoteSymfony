<?php

namespace App\Domain\Service\Factory;

use App\Domain\Entity\Entity;
use App\Domain\Entity\Note;
use App\Domain\Entity\User;
use App\Domain\Repository\UserRepository;

final class NoteFactory implements EntityFactory
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        // TODO: end dependence on Repository, Use current user
        $this->userRepository = $userRepository;
    }

    public function createFromParameters(array $parameters) : Entity
    {
        $note = new Note(
            $parameters['title'] ?? '',
            $parameters['content'] ?? '',
            new \DateTime(),
            $this->getUser($parameters['user']),
            $parameters['id'] ?? null
        );

        return $note;
    }

    private function getUser($user) : User
    {
        if (is_object($user)) {
            return $user;
        }

        return $this->userRepository->getById($user);
    }
}
