<?php

namespace App\Tests\Unit\Controller;

use App\Controller\NoteGetterController;
use App\Domain\Service\Http\Request\GetParameterGetter;

class NoteGetterControllerTest extends ControllerTestBase
{
    private const NOTE_ID = 1;
    private const GET_PARAMETER_KEY = 'noteId';

    public function testHandleRequest(): void
    {
        $getParameterGetter = $this->createMock(GetParameterGetter::class);
        $getParameterGetter->expects($this->any())
            ->method('get')
            ->with(self::GET_PARAMETER_KEY)
            ->willReturn(self::NOTE_ID);

        $controller = new NoteGetterController(
            $this->getUseCase(),
            $getParameterGetter
        );

        $response = $controller->handleRequest();

        $this->assertEquals(self::STATUS_CODE, $response->getStatusCode());
        $this->assertEquals(self::CONTENT, $response->getCOntent());

    }


}
