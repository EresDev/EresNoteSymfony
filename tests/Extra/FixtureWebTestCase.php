<?php

namespace App\Tests\Extra;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class FixtureWebTestCase extends WebTestCase
{
    private $fixtureLoader;

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
        $this->fixtureLoader = $this->getService('App\Tests\Extra\FixtureLoader');
        $this->fixtureLoader->loadFixture($className);
    }

    protected function getFixtureId(string $fixtureClassName, string $fixtureReference = null) : int
    {
        if (is_null($fixtureReference)) {
            $fixtureReference = $fixtureClassName;
        }

        return $this->fixtureLoader
            ->getFixture($fixtureClassName)
            ->getReference($fixtureReference)
            ->getId();
    }

    protected function getEntityManager(): EntityManagerInterface
    {
        return $this->getService('doctrine')->getManager();
    }
}
