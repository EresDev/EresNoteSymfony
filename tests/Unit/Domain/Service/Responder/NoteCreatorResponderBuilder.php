<?php

namespace App\Tests\Unit\Domain\Service\Responder;

use App\Domain\Service\Responder\CreatorResponder;
use App\Domain\Service\Responder\NoteCreatorResponder;
use App\Domain\Repository\EntitySaver;
use App\Domain\Service\Factory\HttpResponseFactory;
use App\Domain\Service\Validator;
use App\Domain\Service\ValueObject\HttpResponse;
use App\Domain\Service\ValueObject\ValidatorResponse;
use PHPUnit\Framework\TestCase;

class NoteCreatorResponderBuilder extends TestCase
{
    protected $validator;
    protected $httpResponseFactory;
    protected $entitySaver;

    public static function getInstance(): self
    {
        return new static();
    }

    public function build() : CreatorResponder
    {
        $this->withValidValidatorResponse();

        return $this->getCreatorResponderInstance();
    }

    public function __construct()
    {
        $this->validator = $this->createMock(Validator::class);

        $this->httpResponseFactory = $this->createMock(
            HttpResponseFactory::class
        );

        $this->entitySaver = $this->createMock(
            EntitySaver::class
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

    public function getCreatorResponderInstance(): CreatorResponder
    {
        return new NoteCreatorResponder(
            $this->validator,
            $this->httpResponseFactory,
            $this->entitySaver
        );
    }
}
