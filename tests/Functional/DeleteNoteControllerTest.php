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

    public function testHandleRequest() : void
    {
        $this->markTestSkipped();

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

        $noteIdAfterDelete = $this->getFixtureId(
            NoteFixture::class,
            NoteFixture::class.'_0'
        );

        $this->assertNull($noteIdAfterDelete);
    }
}
