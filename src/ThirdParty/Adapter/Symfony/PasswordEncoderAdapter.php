<?php

namespace App\ThirdParty\Adapter\Symfony;

use App\Domain\Entity\User;
use App\Domain\Service\PasswordEncoder;
use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class PasswordEncoderAdapter implements PasswordEncoder
{
    private $encoder;

    public function __construct(BCryptPasswordEncoder $encoder)
    {
        $this->encoder = $encoder;
    }

    public function encode(User $user, string $password) : User
    {
        $encoded = $this->encoder->encodePassword($user->getPassword(), null);
        $user->setPassword($encoded);

        return $user;
    }
}
