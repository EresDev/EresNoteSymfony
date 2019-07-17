<?php

namespace App\Tests\Functional;

use App\Tests\Extra\DataFixture\NoteFixture;

class DeleteNoteControllerTest extends FunctionalTestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->loadFixture(NoteFixture::class);

        $this->createAuthenticatedClient();
    }

    public function testHandleRequestWithExistingNote() : void
    {
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
        $noteId = 111;

        $this->sendRequest($noteId);

        $this->assertEquals(404, $this->getResponse()->getStatusCode());
    }
}
