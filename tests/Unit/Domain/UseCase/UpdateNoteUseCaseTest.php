<?php

namespace App\Tests\Unit\Domain\UseCase;

use App\Domain\UseCase\UpdateNoteUseCase;
use App\Tests\Extra\StubFactories;
use App\Tests\Extra\StubServices;
use App\Tests\Extra\ValidEntities;
use App\Tests\Extra\ValidValues;
use PHPUnit\Framework\TestCase;

class UpdateNoteUseCaseTest extends TestCase
{
    private $dummyRequestParameters = [];

    public function testExecute()
    {
        $note = ValidEntities::getNote();
        $entityFactory = StubFactories::getEntityFactory($note);

        $httpResponse = ValidValues::getHttpResponse();
        $responder = StubServices::getResponder($httpResponse);

        $createNoteUseCase = new UpdateNoteUseCase($responder, $entityFactory);
        $response = $createNoteUseCase->execute($this->dummyRequestParameters);

        $this->assertTrue($httpResponse->equals($response));
    }
}
