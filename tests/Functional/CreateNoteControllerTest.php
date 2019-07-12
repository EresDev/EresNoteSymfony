<?php

namespace App\Tests\Functional;

use App\Tests\Extra\DataFixture\UserFixture;
use App\Tests\Extra\Utility;

class CreateNoteControllerTest extends FunctionalTestCase
{
    private $validNoteData;

    protected function setUp()
    {
        parent::setUp();

        $this->validNoteData = [
            'title' => 'A sample title',
            'content' => 'Some test content'
        ];

        $this->createAuthenticatedClient();
    }

    public function testHandleRequestWithValidData() : void
    {
        $this->sendRequest($this->validNoteData);

        $response = $this->getResponse();

        $this->assertEquals(200, $response->getStatusCode());

        $contentObject = $this->toObject(
            $response->getContent()
        );

        $this->assertEquals($this->validNoteData['title'], $contentObject->title);
        $this->assertEquals($this->validNoteData['content'], $contentObject->content);
        $this->assertEquals($this->getAuthUserId(), $contentObject->user->id);
    }

    private function sendRequest($parameters) : void
    {
        $this->request(
            'post',
            '/note',
            $parameters,
            [],
            []
        );
    }

    public function testHandleRequestWithEmptyTitle() : void
    {
        $this->validNoteData['title'] = '';

        $this->sendRequest($this->validNoteData);

        $response = $this->getResponse();
        $this->assertEquals(422, $response->getStatusCode());

        $contentMultiArrayWithErrors = $this->toArrayAssoc($response->getContent());

        $this->assertArrayHasKey('title', $contentMultiArrayWithErrors[0]);
    }

    public function testHandleRequestWithTooBigTitle() : void
    {
        $this->validNoteData['title'] = Utility::generateRandomString(51);

        $this->sendRequest($this->validNoteData);

        $response = $this->getResponse();
        $this->assertEquals(422, $response->getStatusCode());

        $contentMultiArrayWithErrors = $this->toArrayAssoc($response->getContent());

        $this->assertArrayHasKey('title', $contentMultiArrayWithErrors[0]);
    }
}
