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

        $response = $responder->prepare(
            ValidEntities::getNote()
        );

        $this->assertInstanceOf(HttpResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('Test content.', $response->getContent());
    }

    public function testPrepareForInvalidEntity(): void
    {
        $responder = CreateEntityResponderBuilder::getInstance()
            ->withInvalidValidatorResponse()
            ->build(CreateNoteResponder::class);

        $response = $responder->prepare(
            $this->createMock(Note::class)
        );

        $this->assertEquals(422, $response->getStatusCode());
        $this->assertEquals('An error message.', $response->getContent());
    }
}
