<?php

namespace App\ThirdParty\Adapter\Symfony;

use App\Domain\Entity\User;
use App\Domain\Exception\UserNotAuthenticatedException;
use App\Domain\Service\Security\Security;
use Symfony\Component\Security\Core\Security as SymfonySecurity;

class SecurityAdapter implements Security
{
    private $security;

    public function __construct(SymfonySecurity $security)
    {
        $this->security = $security;
    }

    public function getUser(): User
    {
        $user = $this->security->getUser();

        if ($user === null) {
            throw new UserNotAuthenticatedException(
                'User is not authenticated to perform the action.'
            );
        }

        return $user;
    }
}
