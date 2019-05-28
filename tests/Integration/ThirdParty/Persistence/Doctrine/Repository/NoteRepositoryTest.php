<?php

namespace App\Tests\Integration\ThirdParty\Persistence\Doctrine\Repository;

use App\Tests\Extra\DataFixture\NoteFixture;
use App\Tests\Extra\FixtureWebTestCase;
use App\ThirdParty\Persistence\Doctrine\Repository\NoteRepository;

class NoteRepositoryTest extends FixtureWebTestCase
{
    private $repository;

    protected function setUp() : void
    {
        parent::setUp();

        $this->repository = new NoteRepository($this->getEntityManager());
        $this->loadFixture(NoteFixture::class);
    }

    public function testGetById() : void
    {
        $entityId = $this->getFixtureId(NoteFixture::class);

        $entity = $this->repository->getById($entityId);

        $this->assertNotNull($entity);
    }
}
