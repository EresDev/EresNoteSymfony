<?php

namespace App\Tests\Unit\Controller;

use App\Controller\UpdateNoteController;
use App\Domain\Service\Http\Request\PutParametersGetter;
use App\Domain\Service\ValueObject\HttpResponse;
use App\Tests\Extra\StubServices;
use PHPUnit\Framework\TestCase;

class UpdateNoteControllerTest extends TestCase
{
    private const STATUS_CODE = 200;
    private const CONTENT = 'Some content.';

    public function testHandleRequest() : void
    {
        $putParametersGetter = $this->createMock(
            PutParametersGetter::class
        );

        $putParametersGetter->method('getAll')
            ->willReturn(['put_data_key' => 'put_data_value']);

        $useCase = StubServices::getCreateUseCase(
            new HttpResponse(self::STATUS_CODE, self::CONTENT)
        );

        $controller = new UpdateNoteController($useCase, $putParametersGetter);

        $response = $controller->handleRequest();

        $this->assertEquals(self::STATUS_CODE, $response->getStatusCode());
        $this->assertEquals(self::CONTENT, $response->getContent());
    }
}
