<?php

namespace App\Tests\Unit\Domain\Service\Responder;

use App\Domain\Service\CreateUserSuccessHook;
use App\Domain\Service\Factory\HttpResponseFactory;
use App\Domain\Service\Responder\CreateEntityResponderTemplate;
use App\Domain\Service\Responder\CreateUserResponder;
use App\Domain\Service\Validator;
use App\Domain\Service\ValueObject\HttpResponse;
use App\Domain\Service\ValueObject\ValidatorResponse;
use PHPUnit\Framework\TestCase;

class CreateUserResponderBuilder extends TestCase
{
    protected $validator;
    protected $httpResponseFactory;
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

        $this->httpResponseFactory = $this->createMock(
            HttpResponseFactory::class
        );

        $this->successHook = $this->createMock(
            CreateUserSuccessHook::class
        );
    }

    public function withValidValidatorResponse() : self
    {
        $validatorResponse = new ValidatorResponse(true, []);

        $this->validator->method('validate')
            ->willReturn($validatorResponse);

        $this->withHttpResponseFactoryForValidResponse();

        return $this;
    }

    private function withHttpResponseFactoryForValidResponse(): void
    {
        $this->httpResponseFactory->method('create')
            ->willReturn(new HttpResponse(200, 'Test content.'));

    }

    public function withInvalidValidatorResponse(): self
    {
        $validatorResponse = new ValidatorResponse(false, ['An error message.']);

        $this->validator->method('validate')
            ->willReturn($validatorResponse);

        $this->withHttpResponseFactoryForInvalidResponse();

        return $this;
    }

    private function withHttpResponseFactoryForInvalidResponse(): void
    {
        $this->httpResponseFactory->method('create')
            ->willReturn(new HttpResponse(422, 'An error message.'));
    }

    public function getCreatorResponderInstance(): CreateUserResponder {

        return new CreateUserResponder(
            $this->validator,
            $this->httpResponseFactory,
            $this->successHook
        );
    }
}
