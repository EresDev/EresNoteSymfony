<?php

namespace App\ThirdParty\Security\Symfony;

use App\Domain\Entity\User;
use Lexik\Bundle\JWTAuthenticationBundle\Security\User\JWTUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class AuthUser extends User implements JWTUserInterface
{


    public static function createFromPayload($username, array $payload)
    {
        new self(
            $username,
       '',
        1,
        0,
        new \DateTime()
        );
    }
}
