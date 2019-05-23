<?php

namespace App\Tests\Extra\DataFixture;

use App\Domain\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixture extends Fixture
{
    public const USER_REFERENCE = 'USER_REFERENCE';

    public function load(ObjectManager $manager) : void
    {
        $user = new User();
        $user->setEmail('test@eresdev.com');
        $user->setPassword('somePassword1145236@s');
        $user->setActive(true);
        $user->setDeleted(false);
        $user->getMemberSince(new \DateTime());

        $manager->persist($user);
        $manager->flush();

        $this->addReference(self::USER_REFERENCE, $user);
    }

}
