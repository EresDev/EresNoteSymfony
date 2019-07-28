<?php

namespace App\Tests\Unit\Domain\Service\Responder;

use App\Domain\Service\Responder\CreateEntityResponderTemplate;
use App\Domain\Repository\EntitySaver;
use App\Domain\Service\Factory\HttpResponseFactory;
use App\Domain\Service\Validator;
use App\Domain\Service\ValueObject\HttpResponse;
use App\Domain\Service\ValueObject\ValidatorResponse;
use PHPUnit\Framework\TestCase;

class CreateEntityResponderBuilder extends TestCase
{
    const VALIDATOR_ERRORS = ['An error message.'];

    protected $validator;
    protected $entitySaver;

    public static function getInstance(): self
    {
        return new self();
    }

    public function build(string $responderClassName) : CreateEntityResponderTemplate
    {
        $this->withValidValidatorResponse();

        return $this->getCreatorResponderInstance($responderClassName);
    }

    private function __construct()
    {
        $this->validator = $this->createMock(Validator::class);

        $this->entitySaver = $this->createMock(
            EntitySaver::class
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

    public function getCreatorResponderInstance(
        string $responderClassName
    ): CreateEntityResponderTemplate {

        return new $responderClassName(
            $this->validator,
            $this->entitySaver
        );
    }
}
