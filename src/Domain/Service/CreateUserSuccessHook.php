<?php

namespace App\Domain\Service;

use App\Domain\Entity\User;

interface CreateUserSuccessHook
{
    public function process(User $entity) : User;
}
