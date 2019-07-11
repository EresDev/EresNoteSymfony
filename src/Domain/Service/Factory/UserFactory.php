<?php

namespace App\Domain\Service\Factory;

use App\Domain\Entity\Entity;
use App\Domain\Entity\User;
use App\Domain\Service\PasswordEncoder;

class UserFactory implements EntityFactory
{
    private $passwordEncoder;

    public function __construct(PasswordEncoder $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function createFromParameters(array $parameters) : Entity
    {
        $user = new User(
            $parameters['email'] ?? '',
            $parameters['password'] ?? '',
            true,
            false,
            new \DateTime()
        );

        $user = $this->passwordEncoder->encode($user, $parameters['password']);

        return $user;
    }
}
