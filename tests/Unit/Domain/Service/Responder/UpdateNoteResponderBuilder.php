<?php

namespace App\Tests\Unit\Domain\Service\Responder;

use App\Domain\Repository\EntityUpdater;
use App\Domain\Service\Factory\HttpResponseFactory;
use App\Domain\Service\Responder\UpdateNoteResponder;
use App\Domain\Service\Validator;
use App\Domain\Service\ValueObject\HttpResponse;
use App\Domain\Service\ValueObject\ValidatorResponse;
use PHPUnit\Framework\TestCase;

class UpdateNoteResponderBuilder extends TestCase
{
    protected $validator;
    protected $entityUpdater;

    const VALIDATOR_ERRORS = ['foo' => 'bar'];

    public static function getInstance(): self
    {
        return new self();
    }

    public function build() : UpdateNoteResponder
    {
        $this->withValidValidatorResponse();

        return $this->getUpdateNoteResponderInstance();
    }

    public function __construct()
    {
        $this->validator = $this->createMock(Validator::class);

        $this->entityUpdater = $this->createMock(
            EntityUpdater::class
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

    public function getUpdateNoteResponderInstance(): UpdateNoteResponder
    {
        return new UpdateNoteResponder(
            $this->validator,
            $this->entityUpdater
        );
    }
}
