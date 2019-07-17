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
        $this->createAuthenticatedClient();

        $noteId = $this->getFixtureId(
            NoteFixture::class,
            NoteFixture::class.'_0'
        );

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
        $this->createAuthenticatedClient();

        $noteId = 111;

        $this->sendRequest($noteId);

        $this->assertEquals(404, $this->getResponse()->getStatusCode());
    }

    public function testHandleRequestWithDifferentAuthUserThatIsNotTheOwner()
    {
        $this->createAuthenticatedClient(
            AnotherAuthUserFixture::EMAIL,
            AnotherAuthUserFixture::PASSWORD,
            AnotherAuthUserFixture::class
        );

        $validNoteId = $this->getFixtureId(
            NoteFixture::class,
            NoteFixture::class.'_0'
        );

        $this->sendRequest($validNoteId);

        $this->assertEquals(401, $this->getResponse()->getStatusCode());
    }
}
