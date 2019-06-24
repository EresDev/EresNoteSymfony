<?php

namespace App\Tests\Unit\Domain\Service\Responder;

use App\Domain\Entity\Note;
use App\Domain\Service\ValueObject\HttpResponse;
use PHPUnit\Framework\TestCase;

class UpdateNoteResponderTest extends TestCase
{
    public function testPrepareForValidEntity(): void
    {
        $responder = UpdateNoteResponderBuilder::getInstance()
            ->withValidValidatorResponse()
            ->build();

        $response = $responder->prepare(
            $this->createMock(Note::class)
        );

        $this->assertInstanceOf(HttpResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('Test content.', $response->getContent());
    }

    public function testPrepareForInvalidEntity(): void
    {
        $responder = UpdateNoteResponderBuilder::getInstance()
            ->withInvalidValidatorResponse()
            ->build();

        $response = $responder->prepare(
            $this->createMock(Note::class)
        );

        $this->assertEquals(422, $response->getStatusCode());
        $this->assertEquals('An error message.', $response->getContent());
    }
}
