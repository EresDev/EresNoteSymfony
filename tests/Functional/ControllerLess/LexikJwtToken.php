<?php

namespace App\Tests\Functional\ControllerLess;

use App\Tests\Extra\DataFixture\AuthUserFixture;
use App\Tests\Functional\FunctionalTestCase;

class LexikJwtToken extends FunctionalTestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->loadFixture(AuthUserFixture::class);
    }

    public function testJwtTokenGenerationIsSuccess() : void
    {
        $validUser = [
            'email' => AuthUserFixture::EMAIL,
            'password' => AuthUserFixture::PASSWORD
        ];

        $this->sendRequest($validUser);

        $response = $this->getResponse();

        $this->assertEquals(200, $response->getStatusCode());

        $contentArray = $this->toArrayAssoc(
            $response->getContent()
        );

        $this->assertArrayHasKey('token', $contentArray);
    }

    private function sendRequest($parameters) : void
    {
        $this->request(
            'post',
            '/login_check',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($parameters)
        );
    }
}
