<?php

namespace App\Tests\Extra\DataFixture;

use App\Domain\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AuthUserSecondFixture extends Fixture
{
    public const EMAIL = 'auth_user_second@eresdev.com';
    public const PASSWORD = 'somePassword1145236';
    public const ENCODED_PASSWORD =
        '$2y$12$ePhjXGuHR47ALFba/8F8I.ve.IfYoxe8HiI7RbDKXZuN.x/UlAfn.'; //bcrypt, cost 12

    public function load(ObjectManager $manager): void
    {
        $user = $this->getUser();
        $manager->persist($user);
        $this->addReference(self::class, $user);
        $manager->flush();
    }

    public function getUser()
    {
        $user = new User(
             self::EMAIL,
            self::ENCODED_PASSWORD,
            true,
            false,
            new \DateTime()
        );

        return $user;
    }
}
