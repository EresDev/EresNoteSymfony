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
    protected $httpResponseFactory;
    protected $entityUpdater;

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

        $this->httpResponseFactory = $this->createMock(
            HttpResponseFactory::class
        );

        $this->entityUpdater = $this->createMock(
            EntityUpdater::class
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

    public function getUpdateNoteResponderInstance(): UpdateNoteResponder
    {
        return new UpdateNoteResponder(
            $this->validator,
            $this->httpResponseFactory,
            $this->entityUpdater
        );
    }
}
