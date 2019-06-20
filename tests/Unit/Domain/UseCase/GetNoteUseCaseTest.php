<?php

namespace App\Tests\Unit\Domain\UseCase;

use App\Domain\UseCase\GetNoteUseCase;
use App\Tests\Extra\StubServices;
use App\Tests\Extra\ValidEntities;
use App\Tests\Extra\ValidValues;
use PHPUnit\Framework\TestCase;

class GetNoteUseCaseTest extends TestCase
{
    private const NOTE_ID = 1; 
    
    public function testExecute() : void
    {
        $note = ValidEntities::getNote();

        $responseForEntityFound = ValidValues::getHttpResponse(200, $note);
        $responder = StubServices::getResponder($responseForEntityFound);

        $entitySingleGetter = StubServices::getEntitySingleGetter($note);

        $getNoteUseCase = new GetNoteUseCase($responder, $entitySingleGetter);
        $response = $getNoteUseCase->execute(self::NOTE_ID);

        $this->assertTrue($response->equals($responseForEntityFound));
    }
}
