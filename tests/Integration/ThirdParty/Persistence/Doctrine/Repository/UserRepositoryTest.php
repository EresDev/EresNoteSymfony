<?php

namespace App\Tests\Integration\ThirdParty\Persistence\Doctrine\Repository;

use App\Domain\Entity\User;
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

    public function testDeleteForExistingUser() : void
    {
        $userId = $this->getFixtureId(
            UserFixture::class,
            UserFixture::class.'_0'
        );

        $user = $this->repository->delete($userId);
        $this->assertInstanceOf(User::class, $user);
    }

    public function testDeleteForInvalidUser() : void
    {
        $userId = 111;

        $user = $this->repository->delete($userId);
        $this->assertNull($user);
    }
}
