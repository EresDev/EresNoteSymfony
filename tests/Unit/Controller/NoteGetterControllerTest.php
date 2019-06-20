<?php

namespace App\Tests\Unit\Controller;

use App\Controller\NoteGetterController;
use App\Domain\Service\ValueObject\HttpResponse;
use App\Tests\Extra\StubServices;
use App\Tests\Extra\ValidValues;
use PHPUnit\Framework\TestCase;

class NoteGetterControllerTest extends TestCase
{
    private const STATUS_CODE = 200;
    private const CONTENT = 'Some content.';

    private const NOTE_ID = 1;

    public function testHandleRequest(): void
    {
        $pathVariableGetter = StubServices::getPathVariableGetter(self::NOTE_ID);

        $useCase = StubServices::getUseCase(
            ValidValues::getHttpResponse(self::STATUS_CODE, self::CONTENT)
        );

        $controller = new NoteGetterController($useCase, $pathVariableGetter);

        $response = $controller->handleRequest();

        $this->assertEquals(self::STATUS_CODE, $response->getStatusCode());
        $this->assertEquals(self::CONTENT, $response->getContent());
    }

}
