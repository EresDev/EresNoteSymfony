<?php
namespace App\Tests\Integration\ThirdParty\Persistence\Doctrine\Repository;

use App\Tests\Extra\DataFixture\NoteFixture;
use App\Tests\Integration\IntegrationTestCase;
use App\ThirdParty\Persistence\Doctrine\Repository\NoteRepository;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;

class NoteRepositoryTest extends IntegrationTestCase
{
    private $repository;

    protected function setUp() : void
    {
        parent::setUp();
        $entityManager = $this->getService('doctrine')->getManager();
        $this->repository = new NoteRepository($entityManager);

        $purger = new ORMPurger($entityManager);
        $purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $purger->purge();

        $fixture = new NoteFixture();
        $fixture->load($entityManager);
    }

    public function testGetById() : void
    {
        $entity = $this->repository->getById(1);

        $this->assertNotNull($entity);
    }
}
