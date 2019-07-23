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
        $this->singleUserSetUp();

        $this->sendRequest($this->getExistingNoteId());

        $this->assertEquals(200, $this->getResponse()->getStatusCode());
    }

    private function singleUserSetUp() : void
    {
        $this->loadFixtures([NoteFixture::class]);
        $this->createAuthenticatedClient();
    }

    private function getExistingNoteId(): int
    {
        return $this->getFixtureId(
            NoteFixture::class,
            NoteFixture::class.'_0'
        );
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
        $this->singleUserSetUp();

        $noteId = 111;
        $this->sendRequest($noteId);

        $this->assertEquals(404, $this->getResponse()->getStatusCode());
    }

    public function testHandleRequestWithDifferentAuthUserThatIsNotTheOwner()
    {
        $this->doubleUserSetUp();
        $this->sendRequest($this->getExistingNoteId());
        $this->assertEquals(401, $this->getResponse()->getStatusCode());
    }

    private function doubleUserSetUp() : void
    {
        $this->loadFixtures([NoteFixture::class, AuthUserSecondFixture::class]);
        $this->createAuthenticatedClientForSecondUser(
            AuthUserSecondFixture::EMAIL,
            AuthUserSecondFixture::PASSWORD,
            AuthUserSecondFixture::class
        );
    }
}
