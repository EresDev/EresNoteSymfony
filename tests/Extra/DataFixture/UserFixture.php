<?php

namespace App\Tests\Extra\DataFixture;

use App\Domain\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        foreach ($this->getUsers() as $i => $user) {
            $manager->persist($user);

            $this->setReference(self::class . "_$i", $user);
        }
        $manager->flush();
    }

    public function getUsers()
    {
        for ($i = 0; $i < 5; $i++) {
            yield new User (
                "test_$i@eresdev.com",
                'somePassword1145236@s'.$i,
                true,
                false,
                new \DateTime()
            );
        }
    }

}
