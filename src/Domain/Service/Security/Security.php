<?php

namespace App\Domain\Service\Security;

use App\Domain\Entity\User;

interface Security
{
    public function getUser() : User;
    public function isCurrentUser(User $user) : bool;
}
