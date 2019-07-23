<?php

namespace App\Tests\Functional;

use App\Tests\Extra\DataFixture\AuthUserSecondFixture;
use App\Tests\Extra\DataFixture\NoteFixture;

class RetrieveNoteControllerTest extends FunctionalTestCase
{
    protected function setUp()
    {
        parent::setUp();
    }

    public function testHandleRequestWithValidNoteId()
    {
        $this->loadFixtures([NoteFixture::class]);
        $validNoteId = $this->getFixtureId(
            NoteFixture::class,
            NoteFixture::class.'_0'
        );

        $this->createAuthenticatedClient();

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
        $this->loadFixtures([NoteFixture::class]);
        $this->createAuthenticatedClient();

        $invalidNoteId = 0;

        $this->sendRequest($invalidNoteId);

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
