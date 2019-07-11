<?php

namespace App\Tests\Functional;

use App\Tests\Extra\Utility;

class CreateUserControllerTest extends FunctionalTestCase
{
    private $validUserData;

    protected function setUp()
    {
        parent::setUp();

        $this->cleanDatabase();

        $this->validUserData = [
            'email' => 'test_user@eresdev.com',
            'password' => 'someTestPassword1@2'
        ];
    }

    public function testHandleRequestWithValidData() : void
    {
        $this->sendRequest($this->validUserData);
        $response = $this->getResponse();
        $this->assertEquals(200, $response->getStatusCode());

        $contentObject = $this->toObject(
            $response->getContent()
        );
        $this->assertEquals($this->validUserData['email'], $contentObject->email);
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

    public function testHandleRequestWithBlankEmail() : void
    {
        $this->validUserData['email'] = '';
        $this->assertInvalidEmail();
    }

    private function assertInvalidEmail() : void
    {
        $this->sendRequest($this->validUserData);
        $response = $this->getResponse();
        $this->assertEquals(422, $response->getStatusCode());

        $contentMultiArrayWithErrors = $this->toArrayAssoc($response->getContent());
        $this->assertArrayHasKey('email', $contentMultiArrayWithErrors[0]);
    }

    public function testHandleRequestWithSameEmailAgain() : void
    {
        $this->sendRequest($this->validUserData);
        $this->sendRequest($this->validUserData);
        $response = $this->getResponse();
        $this->assertEquals(422, $response->getStatusCode());

        $contentMultiArrayWithErrors = $this->toArrayAssoc($response->getContent());
        $this->assertArrayHasKey('email', $contentMultiArrayWithErrors[0]);
    }

    public function testHandleRequestWithInvalidEmail() : void
    {
        $this->validUserData['email'] = 'anInvalidEmail';
        $this->assertInvalidEmail();
    }

    public function testHandleRequestWithAboveMaxLengthEmail() : void
    {
        $this->validUserData['email'] = Utility::generateRandomString(65).
            '@eresdev.com';
        $this->assertInvalidEmail();
    }

    public function testHandleRequestWithBlankPassword() : void
    {
        $this->validUserData['password'] = '';
        $this->assertInvalidPassword();
    }

    private function assertInvalidPassword() : void
    {
        $this->sendRequest($this->validUserData);
        $response = $this->getResponse();
        $this->assertEquals(422, $response->getStatusCode());

        $contentMultiArrayWithErrors = $this->toArrayAssoc($response->getContent());
        $this->assertArrayHasKey('password', $contentMultiArrayWithErrors[0]);
    }

    public function testHandleRequestWithLessThanMinLengthPassword() : void
    {
        $this->validUserData['password'] = '5Char';
        $this->assertInvalidPassword();
    }

    public function testHandleRequestWithMoreThanMaxLengthPassword() : void
    {
        $this->validUserData['password'] = Utility::generateRandomString(4097);
        $this->assertInvalidPassword();
    }
}
