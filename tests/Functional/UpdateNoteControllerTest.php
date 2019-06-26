<?php

namespace App\Tests\Functional;

use App\Domain\Entity\Note;
use App\Tests\Extra\DataFixture\NoteFixture;
use App\Tests\Extra\Utility;

class UpdateNoteControllerTest extends FunctionalTestCase
{
    private $existingNoteData;

    protected function setUp()
    {
        parent::setUp();

        $this->loadFixture(NoteFixture::class);

        /**
         * @var $note Note
         */
        $note = $this->getFixture(
            NoteFixture::class,
            NoteFixture::class.'_0'
        );

        $this->existingNoteData = [
            'id' => $note->getId(),
            'title' => $note->getTitle(),
            'content' => $note->getContent(),
            'creationDatetime'=> $note->getCreationDatetime(),
            'user' => $note->getUser()
        ];
    }

    public function testHandleRequestUpdateTitle(): void
    {
        $this->existingNoteData['title'] = 'An updated title.';

        $this->sendRequest($this->existingNoteData);

        $response = $this->getResponse();

        $this->assertEquals(200, $response->getStatusCode());

        $contentJson = $response->getContent();
        $contentObject = json_decode($contentJson);

        $this->assertEquals($this->existingNoteData['title'], $contentObject->title);
        $this->assertEquals($this->existingNoteData['content'], $contentObject->content);
        $this->assertEquals(
            $this->existingNoteData['user']->getId(),
            $contentObject->user->id
        );

    }

    private function sendRequest($parameters) : void
    {
        $this->request(
            'put',
            '/note',
            $parameters,
            [],
            []
        );
    }

    public function testHandleRequestWithEmptyTitle() : void
    {
        $this->existingNoteData['title'] = '';

        $this->sendRequest($this->existingNoteData);

        $response = $this->getResponse();
        $this->assertEquals(422, $response->getStatusCode());

        $contentJson = $response->getContent();
        $contentMultiArrayWithErrors = json_decode($contentJson, true);

        $this->assertArrayHasKey('title', $contentMultiArrayWithErrors[0]);
    }

    public function testHandleRequestWithTooBigTitle() : void
    {
        $this->existingNoteData['title'] = Utility::generateRandomString(51);

        $this->sendRequest($this->existingNoteData);

        $response = $this->getResponse();
        $this->assertEquals(422, $response->getStatusCode());

        $contentJson = $response->getContent();
        $contentMultiArrayWithErrors = json_decode($contentJson, true);

        $this->assertArrayHasKey('title', $contentMultiArrayWithErrors[0]);
    }
}
