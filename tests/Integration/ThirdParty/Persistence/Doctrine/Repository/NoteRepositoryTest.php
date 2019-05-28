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
        $entity = $this->repository->getById(1);

        $this->assertNotNull($entity);
    }
}
