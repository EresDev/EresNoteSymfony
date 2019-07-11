<?php

namespace App\ThirdParty\Security\Symfony;

use App\Domain\Entity\User;
use Symfony\Component\Security\Core\User\UserInterface;

class AuthUser extends User implements UserInterface
{
    public function getUsername() : string
    {
        return $this->getEmail();
    }

    public function getRoles() : array
    {
        return ['ROLE_USER'];
    }

    public function getSalt() : ?string
    {
        return '';
    }

    public function eraseCredentials() : void
    {
        $this->setPassword('');
    }
}
