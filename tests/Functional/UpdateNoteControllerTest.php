<?php

namespace App\Tests\Functional;

use App\Domain\Entity\Note;
use App\Tests\Extra\DataFixture\AuthUserSecondFixture;
use App\Tests\Extra\DataFixture\NoteFixture;
use App\Tests\Extra\Utility;

class UpdateNoteControllerTest extends FunctionalTestCase
{
    private $existingNoteData;

    protected function setUp()
    {
        parent::setUp();
    }

    public function testHandleRequestUpdateTitle(): void
    {
        $this->singleUserSetUp();

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

    private function singleUserSetUp() : void
    {
        $this->loadFixtures([NoteFixture::class]);
        $this->prepareNoteData();
        $this->createAuthenticatedClient();
    }

    private function prepareNoteData(): void
    {
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
        $this->singleUserSetUp();

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
        $this->singleUserSetUp();

        $this->existingNoteData['title'] = Utility::generateRandomString(51);

        $this->sendRequest($this->existingNoteData);

        $response = $this->getResponse();
        $this->assertEquals(422, $response->getStatusCode());

        $contentJson = $response->getContent();
        $contentMultiArrayWithErrors = json_decode($contentJson, true);

        $this->assertArrayHasKey('title', $contentMultiArrayWithErrors[0]);
    }

    public function testHandleRequestWhenIdIsMissingFromParameters() : void
    {
        $this->singleUserSetUp();

        $this->existingNoteData['title'] = 'An updated title.';

        array_shift($this->existingNoteData);

        $this->sendRequest($this->existingNoteData);

        $response = $this->getResponse();

        $this->assertEquals(422, $response->getStatusCode());
    }

    public function testHandleRequestToUpdateTitleWithDifferentAuthUserThatIsNotTheOwner() : void
    {
        $this->doubleUserSetUp();

        $this->existingNoteData['title'] = 'An updated title.';

        $this->sendRequest($this->existingNoteData);

        $this->assertEquals(401, $this->getResponse()->getStatusCode());
    }

    private function doubleUserSetUp() : void
    {
        $this->loadFixtures([NoteFixture::class, AuthUserSecondFixture::class]);
        $this->prepareNoteData();
        $this->createAuthenticatedClientForSecondUser(
            AuthUserSecondFixture::EMAIL,
            AuthUserSecondFixture::PASSWORD,
            AuthUserSecondFixture::class
        );
    }
}
