<?php
namespace App\Tests\Integration\ThirdParty\Persistence\Doctrine\Repository;

use App\Tests\Extra\DataFixture\NoteFixture;
use App\Tests\Integration\DbIntegrationTestCase;
use App\ThirdParty\Persistence\Doctrine\Repository\NoteRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class NoteRepositoryTest extends DbIntegrationTestCase
{
    private $repository;

    protected function setUp() : void
    {
        parent::setUp();
        $this->repository = new NoteRepository(parent::getEntityManager());

        $fixture = $this->getService(
            'App\Tests\Extra\DataFixture\NoteFixture'
        );//new NoteFixture();
        $fixture->load(parent::getEntityManager());

    }

    public function testGetById() : void
    {
        $entity = $this->repository->getById(1);

        $this->assertNotNull($entity);
    }
}
