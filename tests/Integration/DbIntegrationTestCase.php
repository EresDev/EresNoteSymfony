<?php

namespace App\Tests\Integration;

use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManagerInterface;

abstract class DbIntegrationTestCase extends IntegrationTestCase
{
    private $entityManager;
    private $fixtureLoader;

    protected function setUp() : void
    {
        parent::setUp();

        $this->entityManager = $this->getService('doctrine')->getManager();
        $this->fixtureLoader = $this->getService(
            Loader::class
        );
    }

    public function getEntityManager() : EntityManagerInterface
    {
        return $this->entityManager;
    }

    protected function loadFixture(string $className) : void
    {
        $this->fixtureLoader->addFixture(new $className());
        $fixtures = $this->fixtureLoader->getFixtures();
        $executor = new ORMExecutor($this->getEntityManager(), $this->getPurger());
        $executor->execute($fixtures);
    }

    private function getPurger() : ORMPurger
    {
        $purger = new ORMPurger($this->getEntityManager());
        $purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);

        return $purger;
    }
}
