<?php
namespace App\Tests\Integration\ThirdParty\Persistence\Doctrine\Repository;

use App\Tests\Extra\DataFixture\NoteFixture;
use App\Tests\Extra\DataFixture\UserFixture;
use App\Tests\Integration\DbIntegrationTestCase;
use App\ThirdParty\Persistence\Doctrine\Repository\NoteRepository;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class NoteRepositoryTest extends DbIntegrationTestCase
{
    private $repository;

    protected function setUp() : void
    {
        parent::setUp();
        $this->repository = new NoteRepository(parent::getEntityManager());

//        $userFixture = $this->getService(
//            'App\Tests\Extra\DataFixture\UserFixture'
//        );
//        $userFixture->load(parent::getEntityManager());
//
//
//        $noteFixture = $this->getService(
//            'App\Tests\Extra\DataFixture\NoteFixture'
//        );
//        $noteFixture->load(parent::getEntityManager());

        $loader = $this->getService(
            Loader::class
        );

        $loader->addFixture(new UserFixture());
        $loader->addFixture(new NoteFixture());

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
