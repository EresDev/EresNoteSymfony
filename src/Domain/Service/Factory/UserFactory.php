<?php

namespace App\Domain\Service\Factory;

use App\Domain\Entity\Entity;
use App\Domain\Entity\User;

class UserFactory implements EntityFactory
{
    public function createFromParameters(array $parameters) : Entity
    {
        $user = new User(
            $parameters['email'] ?? '',
            $parameters['password'] ?? '',
            true,
            false,
            new \DateTime()
        );

        return $user;
    }
}
