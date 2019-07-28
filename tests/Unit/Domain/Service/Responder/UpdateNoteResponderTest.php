<?php

namespace App\Tests\Unit\Domain\Service\Responder;

use App\Domain\Entity\Note;
use App\Domain\Service\ValueObject\HttpResponse;
use App\Tests\Extra\ValidEntities;
use PHPUnit\Framework\TestCase;

class UpdateNoteResponderTest extends TestCase
{
    public function testPrepareForValidEntity(): void
    {
        $responder = UpdateNoteResponderBuilder::getInstance()
            ->withValidValidatorResponse()
            ->build();

        $note = ValidEntities::getNote();
        $response = $responder->prepare($note);

        $this->assertTrue(
            $response->equals(
                HttpResponse::fromObject(200, $note)
            )
        );
    }

    public function testPrepareForInvalidEntity(): void
    {
        $responder = UpdateNoteResponderBuilder::getInstance()
            ->withInvalidValidatorResponse()
            ->build();

        $response = $responder->prepare(
            $this->createMock(Note::class)
        );

        $this->assertTrue(
            $response->equals(
                HttpResponse::fromArray(
                    422,
                    UpdateNoteResponderBuilder::VALIDATOR_ERRORS
                )
            )
        );
    }
}
