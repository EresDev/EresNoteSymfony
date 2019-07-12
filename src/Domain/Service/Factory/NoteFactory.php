<?php

namespace App\Domain\Service\Factory;

use App\Domain\Entity\Entity;
use App\Domain\Entity\Note;
use App\Domain\Service\Security\Security;

final class NoteFactory implements EntityFactory
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function createFromParameters(array $parameters) : Entity
    {
        $entity = new Note(
            $parameters['title'] ?? '',
            $parameters['content'] ?? '',
            new \DateTime(),
            $this->security->getUser(),
            $parameters['id'] ?? null
        );

        return $entity;
    }
}
