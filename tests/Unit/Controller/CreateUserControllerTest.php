<?php

namespace App\Tests\Unit\Controller;

use App\Controller\CreateUserController;
use App\Domain\Service\ValueObject\HttpResponse;
use App\Tests\Extra\StubServices;
use PHPUnit\Framework\TestCase;

class CreateUserControllerTest extends TestCase
{
    private const STATUS_CODE = 200;

    private $validUserData;

    protected function setUp()
    {
        parent::setUp();

        $this->validUserData = ['email' => 'test_user@eresdev.com'];
    }

    public function testHandleRequest(): void
    {
        $postParametersGetter = StubServices::getPostParametersProvider(
            $this->validUserData
        );

        $userDataJson = json_encode($this->validUserData);

        $createUseCase = StubServices::getCreateUseCase(
            new HttpResponse(self::STATUS_CODE, $userDataJson)
        );

        $controller = new CreateUserController($createUseCase, $postParametersGetter);

        $response = $controller->handleRequest();

        $this->assertEquals(self::STATUS_CODE, $response->getStatusCode());
        $this->assertEquals($userDataJson, $response->getContent());
    }
}
