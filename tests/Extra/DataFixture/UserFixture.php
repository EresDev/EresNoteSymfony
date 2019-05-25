<?php

namespace App\Tests\Extra\DataFixture;

use App\Domain\Entity\AbstractEntity;
use App\Domain\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixture extends FixtureTemplate
{
    public function load(ObjectManager $manager): void
    {
        parent::load($manager);

    }

    public function getEntity() : AbstractEntity
    {
        $user = new User();
        $user->setEmail('test@eresdev.com');
        $user->setPassword('somePassword1145236@s');
        $user->setActivated(true);
        $user->setDeleted(false);
        $user->setMemberSince(new \DateTime());

        $this->setReference(self::class, $user);

        return $user;
    }

}
