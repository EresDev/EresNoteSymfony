<?php

namespace App\Tests\Unit\Domain\Service;

use App\Domain\Entity\AbstractEntity;
use App\Domain\Service\ValueObject\SimpleHttpResponseInterface;
use PHPUnit\Framework\TestCase;

class CreatorResponderTest extends TestCase
{
    public function testPrepareForValidEntity(): void
    {
        $creatorResponder = CreatorResponderBuilder::getInstance()
            ->withValidValidatorResponse()
            ->build();

        $response = $creatorResponder->prepare(
            $this->createMock(AbstractEntity::class)
        );

        $this->assertInstanceOf(SimpleHttpResponseInterface::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
    }
}
