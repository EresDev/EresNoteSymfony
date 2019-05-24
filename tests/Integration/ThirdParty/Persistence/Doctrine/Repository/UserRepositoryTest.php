<?php
namespace App\Tests\Integration\ThirdParty\Persistence\Doctrine\Repository;

use App\Tests\Extra\DataFixture\UserFixture;
use App\Tests\Integration\DbIntegrationTestCase;
use App\ThirdParty\Persistence\Doctrine\Repository\UserRepository;

class UserRepositoryTest extends DbIntegrationTestCase
{
    private $repository;

    protected function setUp() : void
    {
        parent::setUp();
        $this->repository = new UserRepository(parent::getEntityManager());

        $fixture = $this->getService(
          'App\Tests\Extra\DataFixture\UserFixture'
        );
            //new UserFixture();
        $fixture->load(parent::getEntityManager());
    }

    public function testGetById() : void
    {
        $entity = $this->repository->getById(1);

        $this->assertNotNull($entity);
    }
}
