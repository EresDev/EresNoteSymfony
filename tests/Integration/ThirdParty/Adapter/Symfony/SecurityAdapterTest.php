<?php

namespace App\Tests\Integration\ThirdParty\Adapter\Symfony;

use App\Domain\Exception\UserNotLoggedInException;
use App\Tests\Extra\ValidEntities;
use App\ThirdParty\Adapter\Symfony\SecurityAdapter;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class SecurityAdapterTest extends WebTestCase
{
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
        $this->expectException(UserNotLoggedInException::class);

        $symfonySecurity = self::$container->get('functional_test.security.helper');
        $security = new SecurityAdapter($symfonySecurity);
        $security->getUser();
    }
}
