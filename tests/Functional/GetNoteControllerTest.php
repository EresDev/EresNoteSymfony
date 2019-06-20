<?php

namespace App\Tests\Functional;

use App\Tests\Extra\DataFixture\NoteFixture;

class GetNoteControllerTest extends FunctionalTestCase
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

        $this->client->request(
            'get',
            '/note/'.$validNoteId,
            [],
            [],
            ['content-type' => 'application/json']
        );

        $response = $this->client->getResponse();

        $contentJson = $response->getContent();
        $contentObject = json_decode($contentJson);

        $this->assertEquals($validNoteId, $contentObject->id);
    }


    public function testHandleRequestWithInvalidNoteId()
    {
        $invalidNoteId = 0;

        $this->client->request(
            'get',
            '/note/'.$invalidNoteId,
            [],
            [],
            ['content-type' => 'application/json']
        );

        $this->assertEquals(404, $this->client->getResponse()->getStatusCode());
    }
}
