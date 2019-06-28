<?php

namespace App\Tests\Unit\Controller;

use App\Controller\DeleteNoteController;
use App\Tests\Extra\StubServices;
use App\Tests\Extra\ValidValues;
use PHPUnit\Framework\TestCase;


class DeleteNoteControllerTest extends TestCase
{
    private const STATUS_CODE = 200;
    private const CONTENT = 'Some content.';

    private const NOTE_ID = 1;

    public function testHandleRequest(): void
    {
        $pathVariableGetter = StubServices::getPathVariableGetter(self::NOTE_ID);

        $retrieveUseCase = StubServices::getRetrieveUseCase(
            ValidValues::getHttpResponse(self::STATUS_CODE, self::CONTENT)
        );

        $controller = new DeleteNoteController($retrieveUseCase, $pathVariableGetter);

        $response = $controller->handleRequest();

        $this->assertEquals(self::STATUS_CODE, $response->getStatusCode());
        $this->assertEquals(self::CONTENT, $response->getContent());
    }
}
