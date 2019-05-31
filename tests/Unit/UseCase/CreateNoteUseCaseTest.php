<?php

namespace App\Tests\Unit\UseCase;

use App\UseCase\CreateNoteUseCase;

class CreateNoteUseCaseTest extends CreatorTestBase
{
    public function testExecute()
    {
        $entity = $this->getEntity(1);
        $entityFactory = $this->getEntityFactory($entity);

        $response = $this->getResponse();
        $responder = $this->getResponder($entity, $response);

        $createNoteUseCase = new CreateNoteUseCase($entityFactory, $responder);

        $response = $createNoteUseCase->execute($this->dummyRequestParameters);

        $this->assertEquals(
            $response->getStatusCode(),
            $response->getStatusCode()
        );

        $this->assertEquals(
            $response->getContent(),
            $response->getContent()
        );
    }

}
