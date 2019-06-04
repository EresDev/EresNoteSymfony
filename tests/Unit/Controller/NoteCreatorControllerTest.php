<?php

namespace App\Tests\Unit\Controller;

use App\Controller\NoteCreatorController;
use App\Domain\Service\Http\Request\PostParametersGetter;
use App\Domain\Service\ValueObject\HttpResponse;
use App\Domain\UseCase\UseCase;
use PHPUnit\Framework\TestCase;

class NoteCreatorControllerTest extends TestCase
{
    public function testHandleRequest(): void
    {
        $useCase = $this->createMock(UseCase::class);
        $useCase->expects($this->any())
            ->method('execute')
            ->willReturn(new HttpResponse(200, 'Some content.'));

        $request = $this->createMock(PostParametersGetter::class);
        $request->expects($this->any())
            ->method('getAll')
            ->willReturn(['post_data_key', 'post_data_value']);

        $controller = new NoteCreatorController($useCase, $request);
        $response = $controller->handleRequest();


        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('Some content.', $response->getContent());
    }
}
