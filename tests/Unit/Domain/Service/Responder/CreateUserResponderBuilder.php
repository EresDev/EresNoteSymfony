<?php

namespace App\Tests\Unit\Domain\Service\Responder;

use App\Domain\Service\CreateUserSuccessHook;
use App\Domain\Service\Responder\CreateUserResponder;
use App\Domain\Service\Validator;
use App\Domain\Service\ValueObject\ValidatorResponse;
use PHPUnit\Framework\TestCase;

class CreateUserResponderBuilder extends TestCase
{
    const VALIDATOR_ERRORS = ['An error message.'];

    protected $validator;
    protected $successHook;

    public static function getInstance(): self
    {
        return new self();
    }

    public function build() : CreateUserResponder
    {
        $this->withValidValidatorResponse();

        return $this->getCreatorResponderInstance();
    }

    private function __construct()
    {
        $this->validator = $this->createMock(Validator::class);

        $this->successHook = $this->createMock(
            CreateUserSuccessHook::class
        );
    }

    public function withValidValidatorResponse() : self
    {
        $validatorResponse = new ValidatorResponse(true, []);

        $this->validator->method('validate')
            ->willReturn($validatorResponse);

        return $this;
    }

    public function withInvalidValidatorResponse(): self
    {
        $validatorResponse = new ValidatorResponse(false, self::VALIDATOR_ERRORS);

        $this->validator->method('validate')
            ->willReturn($validatorResponse);

        return $this;
    }

    public function getCreatorResponderInstance(): CreateUserResponder
    {
        return new CreateUserResponder(
            $this->validator,
            $this->successHook
        );
    }
}
