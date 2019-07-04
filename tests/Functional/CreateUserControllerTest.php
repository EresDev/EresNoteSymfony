<?php

namespace App\Tests\Functional;

class CreateUserControllerTest extends FunctionalTestCase
{
    private $validUserData;

    protected function setUp()
    {
        parent::setUp();

        $this->validUserData = [
            'email' => 'test_user@eresdev.com',
            'password' => 'someTestPassword1@2',
            'confirmEmail' => 'test_user@eresdev.com'
        ];
    }

    public function testHandleRequestWithValidData() : void
    {
        $this->markTestSkipped();
        $this->sendRequest($this->validNoteData);

        $response = $this->getResponse();

        $this->assertEquals(200, $response->getStatusCode());

        $contentObject = $this->toObject(
            $response->getContent()
        );

        $this->assertEquals($this->validNoteData['email'], $contentObject->email);
    }

    private function sendRequest(array $parameters) : void
    {
        $this->request(
            'post',
            '/user',
            $parameters,
            [],
            []
        );
    }
}
