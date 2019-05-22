<?php
namespace EresNote\Tests\Integration\ThirdParty\Persistence\Doctrine\Repository;

use EresNote\Tests\Extra\DataFixture\NoteFixture;
use EresNote\Tests\Integration\IntegrationTestCase;
use EresNote\ThirdParty\Persistence\Doctrine\Repository\NoteRepository;

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
        $noteId = 1111;

        $entity = $this->repository->getById(1111);
        $this->assertEquals($noteId, $entity->getId());

    }
}
