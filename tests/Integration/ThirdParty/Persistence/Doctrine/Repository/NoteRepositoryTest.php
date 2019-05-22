<?php
namespace EresNote\Tests\Integration\ThirdParty\Persistence\Doctrine\Repository;

use EresNote\Tests\Integration\IntegrationTestCase;
use EresNote\ThirdParty\Persistence\Doctrine\Repository\NoteRepository;

class NoteRepositoryTest extends IntegrationTestCase
{
    private $repository;

    protected function setUp() : void
    {
        parent::setUp();
        $entityManager = $this->getService('doctrine')->getManager();
        $this->repository = new NoteRepository($entityManager);
    }

    public function testGetById() : void
    {
        $entity = $this->repository->getById(212);
        $this->assertTrue(false);
    }
}
