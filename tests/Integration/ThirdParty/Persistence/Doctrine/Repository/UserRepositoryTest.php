<?php

namespace App\Tests\Integration\ThirdParty\Persistence\Doctrine\Repository;

use App\Domain\Repository\UserRepositoryInterface;
use App\Tests\Extra\DataFixture\UserFixture;
use App\Tests\Extra\FixtureWebTestCase;
use App\ThirdParty\Persistence\Doctrine\Repository\UserRepository;

class UserRepositoryTest extends FixtureWebTestCase
{
    /**
     * @var UserRepositoryInterface
     */
    private $repository;

    protected function setUp() : void
    {
        parent::setUp();
        $this->repository = new UserRepository(
            parent::getEntityManager()
        );

        $this->loadFixture(UserFixture::class);
    }

    public function testGetById() : void
    {
        $entityId = $this->getFixtureId(
            UserFixture::class,
            UserFixture::class.'_0'
        );

        $entity = $this->repository->getById($entityId);

        $this->assertNotNull($entity);
    }

    public function testGetAll(): void
    {
        $allNotes = $this->repository->getAll();
        $this->assertCount(5, $allNotes);
    }

    public function testGetByEmail(): void
    {
        $user = $this->repository->getBy(['email' => 'test_0@eresdev.com']);
        $this->assertCount(1, $user);
    }

    public function testGetByDeleted(): void
    {
        $notes = $this->repository->getBy(['deleted' => false]);
        $this->assertCount(5, $notes);
    }
}
