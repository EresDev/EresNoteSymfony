<?php

namespace App\Tests\Unit\Domain\Service\Responder;

use App\Domain\Entity\Note;
use App\Domain\Service\ValueObject\HttpResponse;
use PHPUnit\Framework\TestCase;

class NoteCreatorResponderTest extends TestCase
{
    public function testPrepareForValidEntity(): void
    {
        $creatorResponder = NoteCreatorResponderBuilderTemplate::getInstance()
            ->withValidValidatorResponse()
            ->build();

        $response = $creatorResponder->prepare(
            $this->createMock(Note::class)
        );

        $this->assertInstanceOf(HttpResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('Test content.', $response->getContent());
    }

    public function testPrepareForInvalidEntity(): void
    {
        $creatorResponder = NoteCreatorResponderBuilderTemplate::getInstance()
            ->withInvalidValidatorResponse()
            ->build();

        $response = $creatorResponder->prepare(
            $this->createMock(Note::class)
        );

        $this->assertEquals(422, $response->getStatusCode());
        $this->assertEquals('An error message.', $response->getContent());
    }
}
