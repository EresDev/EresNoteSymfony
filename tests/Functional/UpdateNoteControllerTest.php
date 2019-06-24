<?php

namespace App\Tests\Functional;

use App\Domain\Entity\Note;
use App\Tests\Extra\DataFixture\NoteFixture;

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
}
