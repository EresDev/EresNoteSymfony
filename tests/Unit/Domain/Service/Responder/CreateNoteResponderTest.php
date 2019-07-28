<?php

namespace App\Tests\Unit\Domain\Service\Responder;

use App\Domain\Entity\Note;
use App\Domain\Service\Responder\CreateNoteResponder;
use App\Domain\Service\ValueObject\HttpResponse;
use App\Tests\Extra\ValidEntities;
use PHPUnit\Framework\TestCase;

class CreateNoteResponderTest extends TestCase
{
    public function testPrepareForValidEntity(): void
    {
        $responder = CreateEntityResponderBuilder::getInstance()
            ->withValidValidatorResponse()
            ->build(CreateNoteResponder::class);

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
        $responder = CreateEntityResponderBuilder::getInstance()
            ->withInvalidValidatorResponse()
            ->build(CreateNoteResponder::class);

        $note = $this->createMock(Note::class);
        $response = $responder->prepare($note);

        $this->assertTrue(
            $response->equals(
                HttpResponse::fromArray(
                    422,
                    CreateEntityResponderBuilder::VALIDATOR_ERRORS
                )
            )
        );
    }
}
