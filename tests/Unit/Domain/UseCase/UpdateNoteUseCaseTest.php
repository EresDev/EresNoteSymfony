<?php

namespace App\Tests\Unit\Domain\UseCase;

use App\Domain\Exception\ParameterMissingException;
use App\Domain\Service\Security\Ownership;
use App\Domain\UseCase\UpdateNoteUseCase;
use App\Tests\Extra\StubFactories;
use App\Tests\Extra\StubServices;
use App\Tests\Extra\ValidEntities;
use App\Tests\Extra\ValidValues;
use PHPUnit\Framework\TestCase;

class UpdateNoteUseCaseTest extends TestCase
{
    private $dummyRequestParameters = ['id' => 1];

    public function testExecute()
    {
        $note = ValidEntities::getNote();
        $entityFactory = StubFactories::getEntityFactory($note);

        $httpResponse = ValidValues::getHttpResponse();
        $responder = StubServices::getResponder($httpResponse);

        $ownership = $this->createMock(Ownership::class);

        $createNoteUseCase = new UpdateNoteUseCase($responder, $entityFactory, $ownership);
        $response = $createNoteUseCase->execute($this->dummyRequestParameters);

        $this->assertTrue($httpResponse->equals($response));
    }

    public function testExecuteWhenThereIsNotIdInRequestParameters()
    {
        $this->expectException(ParameterMissingException::class);

        $note = ValidEntities::getNote();
        $entityFactory = StubFactories::getEntityFactory($note);

        $httpResponse = ValidValues::getHttpResponse();
        $responder = StubServices::getResponder($httpResponse);

        $ownership = $this->createMock(Ownership::class);

        $createNoteUseCase = new UpdateNoteUseCase($responder, $entityFactory, $ownership);
        $response = $createNoteUseCase->execute([]);
    }
}
