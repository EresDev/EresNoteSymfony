<?php

namespace App\Tests\Functional;

use App\Tests\Extra\DataFixture\UserFixture;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class CreateNoteControllerTest extends FunctionalTestCase
{
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
            "title" => "A sample title",
            "content" => "Some test content",
            "user" => $userIdForFixtures
        ];
    }

    public function testHandleRequestWithValidData() : void
    {
        $validNoteData = $this->validNoteData;

        $this->sendRequest($validNoteData);

        $response = $this->getResponse();

        $this->assertEquals(200, $response->getStatusCode());

        /**
         * @var $headers ResponseHeaderBag
         */

        $contentJson = $response->getContent();
        $contentObject = json_decode($contentJson);

        $this->assertEquals($validNoteData['title'], $contentObject->title);
        $this->assertEquals($validNoteData['content'], $contentObject->content);
        $this->assertEquals($validNoteData['user'], $contentObject->user->id);
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
        $noteData = $this->validNoteData;
        $noteData['title'] = '';

        $this->sendRequest($noteData);

        $response = $this->getResponse();
        $this->assertEquals(422, $response->getStatusCode());

        $contentJson = $response->getContent();
        $contentMultiArray = json_decode($contentJson, true);
        $this->assertArrayHasKey('title', $contentMultiArray[0]);
    }

    public function testHandleRequestWithTooBigTitle() : void
    {
        $noteData = $this->validNoteData;
        $noteData['title'] = $this->generateRandomString(51);

        $this->sendRequest($noteData);

        $response = $this->getResponse();
        $this->assertEquals(422, $response->getStatusCode());

        $contentJson = $response->getContent();
        $contentMultiArray = json_decode($contentJson, true);

        $this->assertArrayHasKey('title', $contentMultiArray[0]);
    }

    private function generateRandomString($length = 10) : string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomIndex = rand(0, $charactersLength - 1);
            $randomString .= $characters[$randomIndex];
        }
        return $randomString;
    }
}
