<?php

namespace App\Domain\Service;

use App\Domain\Entity\User;
use App\Domain\Repository\EntitySaver;

class CreateUserSuccessHookImpl implements CreateUserSuccessHook
{
    private $passwordEncoder;
    private $entitySaver;

    public function __construct(
        PasswordEncoder $passwordEncoder,
        EntitySaver $entitySaver
    ) {
        $this->passwordEncoder = $passwordEncoder;
        $this->entitySaver = $entitySaver;
    }

    public function process(User $user): User
    {
        $user = $this->passwordEncoder->encode($user, $user->getPassword());

        $this->entitySaver->save($user);

        return $user;
    }
}
