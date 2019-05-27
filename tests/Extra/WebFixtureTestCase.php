<?php

namespace App\Tests\Extra;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class WebFixtureTestCase extends WebTestCase
{
    protected function setUp()
    {
        self::bootKernel();
    }

    protected function getService(string $serviceId) : object
    {
        return self::$container->get($serviceId);
    }

    protected function loadFixture(string $className) : void
    {
        $fixtureLoader = $this->getService('App\Tests\Extra\FixtureLoader');
        $fixtureLoader->loadFixture($className);
    }
}
