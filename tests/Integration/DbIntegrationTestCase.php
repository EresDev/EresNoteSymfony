<?php
namespace App\Tests\Integration;

use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManagerInterface;

abstract class DbIntegrationTestCase extends IntegrationTestCase
{
    private $entityManager;

    protected function setUp() : void
    {
        parent::setUp();
        $this->entityManager = $this->getService('doctrine')->getManager();

        //$this->truncateDatabaseTables();
    }

    private function truncateDatabaseTables() : void
    {
        $purger = new ORMPurger($this->getEntityManager());
        $purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $purger->purge();
    }

    public function getEntityManager() : EntityManagerInterface
    {
        return $this->entityManager;
    }
}
