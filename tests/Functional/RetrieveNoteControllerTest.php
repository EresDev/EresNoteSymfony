<?php

namespace App\Tests\Functional;

use App\Tests\Extra\DataFixture\AnotherAuthUserFixture;
use App\Tests\Extra\DataFixture\NoteFixture;

class RetrieveNoteControllerTest extends FunctionalTestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->loadFixture(NoteFixture::class);
    }

    public function testHandleRequestWithValidNoteId()
    {
        $validNoteId = $this->getFixtureId(
            NoteFixture::class,
            NoteFixture::class.'_0'
        );

        $this->createAuthenticatedClientForExistingUser();

        $this->sendRequest($validNoteId);

        $contentJson = $this->getResponse()->getContent();
        $contentObject = $this->toObject($contentJson);

        $this->assertEquals($validNoteId, $contentObject->id);
    }

    private function sendRequest(int $noteId) : void
    {
        $this->client->request(
            'get',
            '/note/'.$noteId,
            [],
            [],
            []
        );
    }


    public function testHandleRequestWithInvalidNoteId()
    {
        $this->createAuthenticatedClientForExistingUser();

        $invalidNoteId = 0;

        $this->sendRequest($invalidNoteId);

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
