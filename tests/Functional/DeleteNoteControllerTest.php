<?php

namespace App\Tests\Functional;

use App\Tests\Extra\DataFixture\AuthUserSecondFixture;
use App\Tests\Extra\DataFixture\NoteFixture;

class DeleteNoteControllerTest extends FunctionalTestCase
{
    protected function setUp()
    {
        parent::setUp();
    }

    public function testHandleRequestWithExistingNote() : void
    {
        $this->loadFixtures([NoteFixture::class]);

        $noteId = $this->getFixtureId(
            NoteFixture::class,
            NoteFixture::class.'_0'
        );

        $this->createAuthenticatedClient();

        $this->sendRequest($noteId);

        $this->assertEquals(200, $this->getResponse()->getStatusCode());
    }

    private function sendRequest(int $noteId) : void
    {
        $this->client->request(
            'delete',
            '/note/'.$noteId,
            [],
            [],
            []
        );
    }

    public function testHandleRequestWithInvalidNote() : void
    {
        $this->loadFixtures([NoteFixture::class]);
        $this->createAuthenticatedClient();

        $noteId = 111;

        $this->sendRequest($noteId);

        $this->assertEquals(404, $this->getResponse()->getStatusCode());
    }

    public function testHandleRequestWithDifferentAuthUserThatIsNotTheOwner()
    {
        $this->loadFixtures([NoteFixture::class, AuthUserSecondFixture::class]);

        $validNoteId = $this->getFixtureId(
            NoteFixture::class,
            NoteFixture::class.'_0'
        );

        $this->createAuthenticatedClientForSecondUser(
            AuthUserSecondFixture::EMAIL,
            AuthUserSecondFixture::PASSWORD,
            AuthUserSecondFixture::class
        );

        $this->sendRequest($validNoteId);
        $this->assertEquals(401, $this->getResponse()->getStatusCode());
    }
}
