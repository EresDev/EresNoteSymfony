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


        $user = ValidEntities::getUser();
        $response = $responder->prepare($user);

        $this->assertTrue(
            $response->equals(
                HttpResponse::fromObject(200, $user)
            )
        );
    }

    public function testPrepareForInvalidEntity(): void
    {
        $responder = CreateUserResponderBuilder::getInstance()
            ->withInvalidValidatorResponse()
            ->build();

        $user = $this->createMock(User::class);
        $response = $responder->prepare($user);

        $this->assertTrue(
            $response->equals(
                HttpResponse::fromArray(
                    422,
                    CreateUserResponderBuilder::VALIDATOR_ERRORS
                )
            )
        );
    }
}
