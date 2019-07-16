<?php

namespace App\Tests\Integration\ThirdParty\Adapter\Symfony;

use App\Domain\Entity\User;
use App\Domain\Exception\UserNotAuthenticatedException;
use App\Domain\Repository\EntityOwnerProvider;
use App\Tests\Extra\ValidEntities;
use App\ThirdParty\Adapter\Symfony\SecurityAdapter;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class SecurityAdapterTest extends WebTestCase
{
    private $entityOwned;
    protected function setUp()
    {
        parent::setUp();
        self::bootKernel();
    }

    public function testGetUser(): void
    {
        $user = ValidEntities::getUser();
        $token = new UsernamePasswordToken($user, '', 'provider', ['ROLE_USER']);
        self::$container->get('security.token_storage')->setToken($token);
        $symfonySecurity = self::$container->get('functional_test.security.helper');

        $security = new SecurityAdapter($symfonySecurity);
        $userFromAdapter = $security->getUser();

        $this->assertEquals($user->getEmail(), $userFromAdapter->getEmail());
    }

    public function testGetUserWhenThereIsNoUserLoggedIn() : void
    {
        $this->expectException(UserNotAuthenticatedException::class);

        $symfonySecurity = self::$container->get('functional_test.security.helper');
        $security = new SecurityAdapter($symfonySecurity);
        $security->getUser();
    }

    public function testIsCurrentUser(): void
    {
        $user = ValidEntities::getUser();
        $token = new UsernamePasswordToken($user, '', 'provider', ['ROLE_USER']);
        self::$container->get('security.token_storage')->setToken($token);
        $symfonySecurity = self::$container->get('functional_test.security.helper');

        $security = new SecurityAdapter($symfonySecurity);

        $this->assertTrue($security->isCurrentUser($user));
    }

    public function testIsCurrentUserWhenUserIsNotCurrent(): void
    {
        $user = ValidEntities::getUser();
        $token = new UsernamePasswordToken($user, '', 'provider', ['ROLE_USER']);
        self::$container->get('security.token_storage')->setToken($token);
        $symfonySecurity = self::$container->get('functional_test.security.helper');

        $security = new SecurityAdapter($symfonySecurity);

        $anotherUser = new User(
            'someEmail@eresdev.com',
            'somePassword',
            true,
            false,
            new \DateTime()
        );

        $anotherUser->setId(2);

        $this->assertFalse($security->isCurrentUser($anotherUser));
    }
}
