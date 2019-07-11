<?php

namespace App\Tests\Extra;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\DBAL\Platforms\MySqlPlatform;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class FixtureLoader
{
    //TODO: Refactor this class
    // Container is only injected to autowire AuthUserFixture, to use factory
    // to facilitate password encoding
    // try to to bring existing fixture loader in action if there is any, find out

    private $entityManager;
    private $loader;
    private $registry;
    private $container;

    public function __construct(
        EntityManagerInterface $entityManager,
        Loader $loader,
        ManagerRegistry $registry,
        ContainerInterface $container
    ) {
        $this->entityManager = $entityManager;
        $this->loader = $loader;
        $this->registry = $registry;
        $this->container = $container;

        $this->cleanDatabase();
    }

    public function loadFixture(string $className) : void
    {
        $fixture = $this->container->get($className);
        $this->loader->addFixture($fixture);
        $executor = new ORMExecutor($this->entityManager, new ORMPurger());
        $executor->execute($this->loader->getFixtures());
    }

    public function getFixture(string $className) : Fixture
    {
        return $this->loader->getFixture($className);
    }

    private function getPurger() : ORMPurger
    {
        $purger = new ORMPurger($this->entityManager);
        $purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);

        return $purger;
    }

    public function cleanDatabase() : void
    {
        $connection = $this->entityManager->getConnection();

        $mysql = ('ORM' === $this->registry->getName()
            && $connection->getDatabasePlatform() instanceof MySqlPlatform);
        if ($mysql) {
            $connection->query('SET FOREIGN_KEY_CHECKS=0');
        }
        $this->getPurger()->purge();
        if ($mysql) {
            $connection->query('SET FOREIGN_KEY_CHECKS=1');
        }
    }
}
