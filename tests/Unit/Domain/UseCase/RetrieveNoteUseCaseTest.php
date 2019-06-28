<?php

namespace App\Tests\Unit\Domain\UseCase;

use App\Domain\UseCase\RetrieveNoteUseCase;
use App\Tests\Extra\StubServices;
use App\Tests\Extra\ValidEntities;
use App\Tests\Extra\ValidValues;
use PHPUnit\Framework\TestCase;

class RetrieveNoteUseCaseTest extends TestCase
{
    private const NOTE_ID = 1; 
    
    public function testExecute() : void
    {
        $note = ValidEntities::getNote();

        $responseForEntityFound = ValidValues::getHttpResponse(200, $note);
        $responder = StubServices::getResponder($responseForEntityFound);

        $entitySingleGetter = StubServices::getEntitySingleGetter($note);

        $retrieveNoteUseCase = new RetrieveNoteUseCase($responder, $entitySingleGetter);
        $response = $retrieveNoteUseCase->execute(self::NOTE_ID);

        $this->assertTrue($response->equals($responseForEntityFound));
    }
}
