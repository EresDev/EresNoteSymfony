<?php

namespace App\Tests\Functional;

use App\Tests\Extra\DataFixture\UserFixture;
use App\Tests\Extra\Utility;
use App\Domain\Service\Factory\HttpResponseFactory;
use App\Domain\Service\Validator;

class CreateNoteControllerTest extends FunctionalTestCase
{
    // TODO: userId should not be sent in request, use security and
    // update it and update assertions

    private $validNoteData;

    protected function setUp()
    {
        parent::setUp();

        $this->loadFixture(UserFixture::class);

        $userIdForFixtures = $this->getFixtureId(
            UserFixture::class,
            UserFixture::class.'_0'
        );
        $this->validNoteData = [
            'title' => 'A sample title',
            'content' => 'Some test content',
            'user' => $userIdForFixtures
        ];
    }

    public function testHandleRequestWithValidData() : void
    {
        $this->sendRequest($this->validNoteData);

        $response = $this->getResponse();

        $this->assertEquals(200, $response->getStatusCode());

        $contentJson = $response->getContent();
        $contentObject = json_decode($contentJson);

        $this->assertEquals($this->validNoteData['title'], $contentObject->title);
        $this->assertEquals($this->validNoteData['content'], $contentObject->content);
        $this->assertEquals($this->validNoteData['user'], $contentObject->user->id);
    }

    private function sendRequest($parameters) : void
    {
        $this->request(
            'post',
            '/note',
            $parameters,
            [],
            []//['content-type' => $this->contentType]
        );
    }

    public function testHandleRequestWithEmptyTitle() : void
    {
        $this->validNoteData['title'] = '';

        $this->sendRequest($this->validNoteData);

        $response = $this->getResponse();
        $this->assertEquals(422, $response->getStatusCode());

        $contentJson = $response->getContent();
        $contentMultiArrayWithErrors = json_decode($contentJson, true);

        $this->assertArrayHasKey('title', $contentMultiArrayWithErrors[0]);
    }

    public function testHandleRequestWithTooBigTitle() : void
    {
        $this->validNoteData['title'] = Utility::generateRandomString(51);

        $this->sendRequest($this->validNoteData);

        $response = $this->getResponse();
        $this->assertEquals(422, $response->getStatusCode());

        $contentJson = $response->getContent();
        $contentMultiArrayWithErrors = json_decode($contentJson, true);

        $this->assertArrayHasKey('title', $contentMultiArrayWithErrors[0]);
    }
}
