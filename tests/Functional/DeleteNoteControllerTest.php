<?php

namespace App\Tests\Functional;

use App\Tests\Extra\DataFixture\AnotherAuthUserFixture;
use App\Tests\Extra\DataFixture\NoteFixture;

class DeleteNoteControllerTest extends FunctionalTestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->loadFixture(NoteFixture::class);
    }

    public function testHandleRequestWithExistingNote() : void
    {
        $noteId = $this->getFixtureId(
            NoteFixture::class,
            NoteFixture::class.'_0'
        );

        $this->createAuthenticatedClientForExistingUser();

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
        $this->createAuthenticatedClientForExistingUser();

        $noteId = 111;

        $this->sendRequest($noteId);

        $this->assertEquals(404, $this->getResponse()->getStatusCode());
    }

    public function testHandleRequestWithDifferentAuthUserThatIsNotTheOwner()
    {
        $validNoteId = $this->getFixtureId(
            NoteFixture::class,
            NoteFixture::class.'_0'
        );

        $this->createAuthenticatedClientForNewUser(
            AnotherAuthUserFixture::EMAIL,
            AnotherAuthUserFixture::PASSWORD,
            AnotherAuthUserFixture::class
        );

        $this->sendRequest($validNoteId);

        $this->assertEquals(401, $this->getResponse()->getStatusCode());
    }
}
