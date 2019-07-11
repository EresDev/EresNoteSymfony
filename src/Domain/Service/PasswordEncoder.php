<?php

namespace App\Domain\Service;

use App\Domain\Entity\User;

interface PasswordEncoder
{
    public function encode(User $user, string $password): User;
}
