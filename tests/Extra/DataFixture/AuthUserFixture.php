<?php

namespace App\Tests\Extra\DataFixture;

use App\Domain\Service\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AuthUserFixture extends Fixture
{
    public const EMAIL = 'auth_user@eresdev.com';
    public const PASSWORD = 'somePassword1145236';

    private $userFactory;

    public function __construct(UserFactory $userFactory)
    {
        $this->userFactory = $userFactory;
    }

    public function load(ObjectManager $manager): void
    {
        $user = $this->getUser();
        $manager->persist($user);
        $this->addReference(self::class, $user);
        $manager->flush();
    }

    public function getUser()
    {
        $user = $this->userFactory->createFromParameters([
            'email' => self::EMAIL,
            'password' => self::PASSWORD,
            'activated' => true,
            'deleted' => false
        ]);

        return $user;
    }
}
