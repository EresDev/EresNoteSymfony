<?php

namespace App\Tests\Integration\ThirdParty\Persistence\Doctrine\Repository;

use App\Domain\Repository\UserRepository;
use App\Tests\Extra\DataFixture\UserFixture;
use App\Tests\Extra\FixtureWebTestCase;
use App\ThirdParty\Persistence\Doctrine\Repository\UserRepositoryImpl;

class UserRepositoryTest extends FixtureWebTestCase
{
    /**
     * @var UserRepository
     */
    private $repository;

    protected function setUp() : void
    {
        parent::setUp();
        $this->repository = new UserRepositoryImpl(
            parent::getEntityManager()
        );

        $this->loadFixture(UserFixture::class);
    }

    public function testGetById() : void
    {
        $userId = $this->getFixtureId(
            UserFixture::class,
            UserFixture::class.'_0'
        );

        $entity = $this->repository->getById($userId);

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

    public function testDeleteForExistingUser() : void
    {
        $userId = $this->getFixtureId(
            UserFixture::class,
            UserFixture::class.'_0'
        );

        $isDeleted = $this->repository->delete($userId);
        $this->assertTrue($isDeleted);
    }

    public function testDeleteForInvalidUser() : void
    {
        $userId = 111;

        $isDeleted = $this->repository->delete($userId);
        $this->assertFalse($isDeleted);
    }
}
