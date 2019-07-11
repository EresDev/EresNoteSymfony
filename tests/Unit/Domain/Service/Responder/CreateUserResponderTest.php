<?php

namespace App\Tests\Unit\Domain\Service\Responder;

use App\Domain\Entity\User;
use App\Domain\Service\ValueObject\HttpResponse;
use App\Tests\Extra\ValidEntities;
use PHPUnit\Framework\TestCase;

class CreateUserResponderTest extends TestCase
{
    public function testPrepareForValidEntity(): void
    {
        $responder = CreateUserResponderBuilder::getInstance()
            ->withValidValidatorResponse()
            ->build();

        $response = $responder->prepare(
            ValidEntities::getUser()
        );

        $this->assertInstanceOf(HttpResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('Test content.', $response->getContent());
    }

    public function testPrepareForInvalidEntity(): void
    {
        $responder = CreateUserResponderBuilder::getInstance()
            ->withInvalidValidatorResponse()
            ->build();

        $response = $responder->prepare(
            $this->createMock(User::class)
        );

        $this->assertEquals(422, $response->getStatusCode());
        $this->assertEquals('An error message.', $response->getContent());
    }
}
