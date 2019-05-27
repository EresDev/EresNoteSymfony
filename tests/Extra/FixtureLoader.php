<?php

namespace App\Tests\Extra;

use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManagerInterface;

class FixtureLoader
{
    private $entityManager;
    private $delegateLoader;

    public function __construct(
        EntityManagerInterface $entityManager,
        Loader $loader
    ) {
        $this->entityManager = $entityManager;
        $this->delegateLoader = $loader;
    }

    public function loadFixture(string $className) : void
    {
        $this->delegateLoader->addFixture(new $className());
        $fixtures = $this->delegateLoader->getFixtures();
        $executor = new ORMExecutor($this->entityManager, $this->getPurger());
        $executor->execute($fixtures);
    }

    private function getPurger() : ORMPurger
    {
        $purger = new ORMPurger($this->entityManager);
        $purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);

        return $purger;
    }
}
