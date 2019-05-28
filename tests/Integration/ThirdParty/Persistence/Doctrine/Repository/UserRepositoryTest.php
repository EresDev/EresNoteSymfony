<?php

namespace App\Tests\Integration\ThirdParty\Persistence\Doctrine\Repository;

use App\Domain\Entity\User;
use App\Tests\Extra\DataFixture\UserFixture;
use App\Tests\Extra\FixtureWebTestCase;
use App\ThirdParty\Persistence\Doctrine\Repository\UserRepository;

class UserRepositoryTest extends FixtureWebTestCase
{
    private $repository;

    protected function setUp() : void
    {
        parent::setUp();
        $this->repository = new UserRepository(parent::getEntityManager());

        $this->loadFixture(UserFixture::class);
    }

    public function testGetById() : void
    {
        $entityId = $this->getFixtureId(UserFixture::class);

        $entity = $this->repository->getById($entityId);

        $this->assertNotNull($entity);
    }
}
