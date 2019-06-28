<?php

namespace App\Tests\Unit\Controller;

use App\Controller\CreateNoteController;
use App\Domain\Service\Http\Request\PostParametersGetter;
use App\Domain\Service\ValueObject\HttpResponse;
use App\Tests\Extra\StubServices;
use PHPUnit\Framework\TestCase;

class CreateNoteControllerTest extends TestCase
{
    private const STATUS_CODE = 200;
    private const CONTENT = 'Some content.';

    public function testHandleRequest(): void
    {
        $postParametersGetter = $this->createMock(
            PostParametersGetter::class
        );
        
        $postParametersGetter->method('getAll')
            ->willReturn(['post_data_key' => 'post_data_value']);

        $createUseCase = StubServices::getCreateUseCase(
            new HttpResponse(self::STATUS_CODE, self::CONTENT)
        );

        $controller = new CreateNoteController($createUseCase, $postParametersGetter);

        $response = $controller->handleRequest();

        $this->assertEquals(self::STATUS_CODE, $response->getStatusCode());
        $this->assertEquals(self::CONTENT, $response->getContent());
    }
}
