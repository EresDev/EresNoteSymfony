<?php

namespace App\Tests\Integration\ThirdParty\Persistence\Doctrine\Repository;

use App\Tests\Extra\DataFixture\NoteFixture;
use App\Tests\Extra\FixtureWebTestCase;
use App\ThirdParty\Persistence\Doctrine\Repository\NoteRepositoryImpl;

class NoteRepositoryTest extends FixtureWebTestCase
{
    /**
     * @var NoteRepositoryImpl
     */
    private $repository;

    protected function setUp() : void
    {
        parent::setUp();

        $this->repository = new NoteRepositoryImpl($this->getEntityManager());
        $this->loadFixture(NoteFixture::class);
    }

    public function testGetById() : void
    {
        $noteId = $this->getFixtureId(
            NoteFixture::class,
            NoteFixture::class . '_0'

        );

        $entity = $this->repository->getById($noteId);

        $this->assertNotNull($entity);
    }

    public function testGetAll(): void
    {
        $allNotes = $this->repository->getAll();
        $this->assertCount(5, $allNotes);
    }

    public function testGetByTitle(): void
    {
        $note = $this->repository->getBy(['title' => 'Some title 0']);
        $this->assertCount(1, $note);
    }

    public function testGetByContent(): void
    {
        $note = $this->repository->getBy(['content' => 'Some test content 0']);
        $this->assertCount(1, $note);
    }

    public function testDeleteForExistingNote() : void
    {
        $noteId = $this->getFixtureId(
            NoteFixture::class,
            NoteFixture::class . '_0'

        );

        $isDeleted = $this->repository->delete($noteId);
        $this->assertTrue($isDeleted);
    }

    public function testDeleteForInvalidNote() : void
    {
        $noteId = 111;

        $isDeleted = $this->repository->delete($noteId);
        $this->assertFalse($isDeleted);
    }
}
