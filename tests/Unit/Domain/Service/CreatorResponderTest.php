<?php

namespace App\Tests\Unit\Domain\Service;

use App\Domain\Entity\Entity;
use App\Domain\Service\ValueObject\HttpResponse;
use PHPUnit\Framework\TestCase;

class CreatorResponderTest extends TestCase
{
    public function testPrepareForValidEntity(): void
    {
        $creatorResponder = CreatorResponderBuilder::getInstance()
            ->withValidValidatorResponse()
            ->build();

        $response = $creatorResponder->prepare(
            $this->createMock(Entity::class)
        );

        $this->assertInstanceOf(HttpResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('Test content.', $response->getContent());
    }

    public function testPrepareForInvalidEntity(): void
    {
        $creatorResponder = CreatorResponderBuilder::getInstance()
            ->withInvalidValidatorResponse()
            ->build();

        $response = $creatorResponder->prepare(
            $this->createMock(Entity::class)
        );

        $this->assertEquals(422, $response->getStatusCode());
        $this->assertEquals('An error message.', $response->getContent());
    }
}
