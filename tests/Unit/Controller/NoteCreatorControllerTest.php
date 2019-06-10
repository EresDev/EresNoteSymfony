<?php

namespace App\Tests\Unit\Controller;

use App\Controller\NoteCreatorController;
use App\Domain\Service\Http\Request\PostParametersGetter;

class NoteCreatorControllerTest extends ControllerTestBase
{
    public function testHandleRequest(): void
    {
        $postParametersGetter = $this->createMock(PostParametersGetter::class);
        $postParametersGetter->expects($this->any())
            ->method('getAll')
            ->willReturn(['post_data_key', 'post_data_value']);

        $controller = new NoteCreatorController(
            $this->getUseCase(),
            $postParametersGetter
        );

        $response = $controller->handleRequest();

        $this->assertEquals(self::STATUS_CODE, $response->getStatusCode());
        $this->assertEquals(self::CONTENT, $response->getContent());
    }
}
