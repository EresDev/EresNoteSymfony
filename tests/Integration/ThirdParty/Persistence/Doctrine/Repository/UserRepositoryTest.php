<?php
namespace App\Tests\Integration\ThirdParty\Persistence\Doctrine\Repository;

use App\Tests\Extra\DataFixture\UserFixture;
use App\Tests\Integration\DbIntegrationTestCase;
use App\ThirdParty\Persistence\Doctrine\Repository\UserRepository;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;

class UserRepositoryTest extends DbIntegrationTestCase
{
    private $repository;

    protected function setUp() : void
    {
        parent::setUp();
        $this->repository = new UserRepository(parent::getEntityManager());

//        $fixture = $this->getService(-
//          'App\Tests\Extra\DataFixture\UserFixture'
//        );
//
//        $fixture->load(parent::getEntityManager());


        $loader = $this->getService(
            Loader::class
        );

        $loader->addFixture(new UserFixture());

        $fixtures = $loader->getFixtures();

        $purger = new ORMPurger();
        $executor = new ORMExecutor($this->getEntityManager(), $purger);
        $executor->execute($fixtures);
    }

    public function testGetById() : void
    {
        $entity = $this->repository->getById(1);

        $this->assertNotNull($entity);
    }
}
