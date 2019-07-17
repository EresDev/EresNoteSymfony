<?php

namespace App\Tests\Unit\Domain\UseCase;

use App\Domain\Service\Security\Ownership;
use App\Domain\UseCase\DeleteNoteUseCase;
use App\Tests\Extra\StubServices;
use App\Tests\Extra\ValidEntities;
use App\Tests\Extra\ValidValues;
use PHPUnit\Framework\TestCase;

class DeleteNoteUseCaseTest extends TestCase
{
    private const HTTP_STATUS_CODE = 200;
    private const CONTENT = 'Some content.';

    private const NOTE_ID = 1;

    public function testExecute() : void
    {
        $httpResponse = ValidValues::getHttpResponse(
            self::HTTP_STATUS_CODE,
            self::CONTENT
        );
        $responder = StubServices::getResponder($httpResponse);

        $ownership = $this->createMock(Ownership::class);

        $entityDeleter = StubServices::getEntityDeleter(
            ValidEntities::getNote()
        );

        $useCase = new DeleteNoteUseCase(
            $responder,
            $ownership,
            $entityDeleter
        );

        $response = $useCase->execute(self::NOTE_ID);

        $this->assertTrue($httpResponse->equals($response));
    }
}
