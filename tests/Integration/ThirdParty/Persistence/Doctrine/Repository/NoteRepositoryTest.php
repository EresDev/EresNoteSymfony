<?php
namespace App\Tests\Integration\ThirdParty\Persistence\Doctrine\Repository;

use App\Tests\Extra\DataFixture\NoteFixture;
use App\Tests\Integration\IntegrationTestCase;
use App\ThirdParty\Persistence\Doctrine\Repository\NoteRepository;

class NoteRepositoryTest extends IntegrationTestCase
{
    private $repository;

    protected function setUp() : void
    {
        parent::setUp();
        $entityManager = $this->getService('doctrine')->getManager();
        $this->repository = new NoteRepository($entityManager);

        $fixture = new NoteFixture();
        $fixture->load($entityManager);
    }

    public function testGetById() : void
    {
        $this->markTestSkipped('must be revisited.');
        $noteId = 1111;

        $entity = $this->repository->getById(1111);
        $this->assertEquals($noteId, $entity->getId());

    }
}
