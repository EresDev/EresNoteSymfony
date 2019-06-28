<?php

namespace App\Tests\Functional;

use App\Tests\Extra\DataFixture\NoteFixture;

class DeleteNoteControllerTest extends FunctionalTestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->loadFixture(NoteFixture::class);

        $this->client = static::createClient();
    }

    public function testHandleRequestWithExistingNote() : void
    {
        $noteId = $this->getFixtureId(
            NoteFixture::class,
            NoteFixture::class.'_0'
        );

        $this->client->request(
            'delete',
            '/note/'.$noteId,
            [],
            [],
            ['content-type' => 'application/json']
        );

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    public function testHandleRequestWithInvalidNote() : void
    {
        $noteId = 111;

        $this->client->request(
            'delete',
            '/note/'.$noteId,
            [],
            [],
            ['content-type' => 'application/json']
        );

        $this->assertEquals(404, $this->client->getResponse()->getStatusCode());
    }
}
