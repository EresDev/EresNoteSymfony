<?php

namespace App\Tests\Functional;

use App\Tests\Extra\DataFixture\UserFixture;
use App\Tests\Extra\FixtureWebTestCase;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class NoteCreatorControllerTest extends FixtureWebTestCase
{
    /**
     * @var \Symfony\Component\BrowserKit\Client
     */
    private $client;
    private $validNoteData = [
        "title" => "A sample title",
        "content" => "Some test content",
        "user" => 1
    ];
    private $contentType = 'application/json';

    protected function setUp()
    {
        parent::setUp();

        $this->loadFixture(UserFixture::class);

        $this->client = static::createClient();
    }

    public function testCreate_withValidData() : void
    {
        $validNoteData = $this->validNoteData;
        $this->sendRequest($validNoteData);

        $response = $this->client->getResponse();

        $this->assertEquals(200, $response->getStatusCode());

        /**
         * @var $headers ResponseHeaderBag
         */
        $headers = $response->headers;
        $this->assertEquals($this->contentType, $headers->get('content-type'));

        $contentJson = $response->getContent();
        $contentObject = json_decode($contentJson);

        $this->assertEquals($validNoteData['title'], $contentObject->title);
        $this->assertEquals($validNoteData['content'], $contentObject->content);
        $this->assertEquals($validNoteData['user'], $contentObject->user->id);
    }

    private function sendRequest($parameters) : void
    {
        $this->client->request(
            'post',
            '/note',
            $parameters,
            [],
            ['content-type' => $this->contentType]
        );
    }

    public function testCreate_withEmptyTitle() : void
    {
        $noteData = $this->validNoteData;
        $noteData['title'] = '';

        $this->sendRequest($noteData);

        $response = $this->client->getResponse();
        $this->assertEquals(422, $response->getStatusCode());

        $headers = $response->headers;
        $this->assertEquals($this->contentType, $headers->get('content-type'));

        $contentJson = $response->getContent();
        $contentMultiArray = json_decode($contentJson, true);
        $this->assertArrayHasKey('title', $contentMultiArray[0]);
    }

    public function testCreate_withTooBigTitle() : void
    {
        $noteData = $this->validNoteData;
        $noteData['title'] = $this->generateRandomString(51);

        $this->sendRequest($noteData);

        $response = $this->client->getResponse();
        $this->assertEquals(422, $response->getStatusCode());

        $headers = $response->headers;
        $this->assertEquals($this->contentType, $headers->get('content-type'));

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
