<?php

namespace App\Tests\Extra;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class FixtureWebTestCase extends WebTestCase
{
    /**
     * @var FixtureLoader
     */
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
        $this->fixtureLoader = $this->getService(FixtureLoader::class);
        $this->fixtureLoader->loadFixture($className);
    }

    protected function getFixtureId(
        string $fixtureClassName,
        string $fixtureReference = null
    ) : int {

        return $this->getFixture($fixtureClassName, $fixtureReference)
            ->getId();
    }

    protected function getFixture(
        string $fixtureClassName,
        string $fixtureReference = null
    ): object {
        if (is_null($fixtureReference)) {
            $fixtureReference = $fixtureClassName;
        }

        return $this->fixtureLoader
            ->getFixture($fixtureClassName)
            ->getReference($fixtureReference);
    }

    protected function getEntityManager(): EntityManagerInterface
    {
        return $this->getService('doctrine')->getManager();
    }
}
