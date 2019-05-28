<?php

namespace App\Tests\Extra;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManagerInterface;

class FixtureLoader
{
    private $entityManager;
    private $loader;

    public function __construct(
        EntityManagerInterface $entityManager,
        Loader $loader
    ) {
        $this->entityManager = $entityManager;
        $this->loader = $loader;
    }

    public function loadFixture(string $className) : void
    {
        $this->loader->addFixture(new $className());
        $executor = new ORMExecutor($this->entityManager, $this->getPurger());
        $executor->execute($this->loader->getFixtures());
    }

    public function getFixture(string $className) : Fixture
    {
        return $this->loader->getFixture($className);
    }

    private function getPurger() : ORMPurger
    {
        $purger = new ORMPurger($this->entityManager);
        $purger->setPurgeMode(ORMPurger::PURGE_MODE_DELETE);

        return $purger;
    }
}
