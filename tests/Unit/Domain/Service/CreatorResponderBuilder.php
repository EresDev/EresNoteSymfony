<?php

namespace App\Tests\Unit\Domain\Service;

use App\Domain\Entity\Entity;
use App\Domain\Repository\Repository;
use App\Domain\Service\CreatorResponder;
use App\Domain\Service\Factory\RepositoryFactory;
use App\Domain\Service\Factory\ResponseFactory;
use App\Domain\Service\Validator;
use App\Domain\Service\ValueObject\ValidatorResponse;
use App\ThirdParty\Proxy\ResponseProxy;
use PHPUnit\Framework\TestCase;

class CreatorResponderBuilder extends TestCase
{
    private $validator;
    private $repositoryFactory;
    private $responseFactory;

    public static function getInstance(): CreatorResponderBuilder
    {
        return new self();
    }

    public function __construct()
    {
        $this->validator = $this->createMock(Validator::class);
        $this->repositoryFactory = $this->createMock(
            RepositoryFactory::class
        );
        $this->responseFactory = $this->createMock(
            ResponseFactory::class
        );


    }

    public function withValidValidatorResponse() : self
    {
        $validatorResponse = new ValidatorResponse(true, []);

        $this->validator->method('validate')
            ->willReturn($validatorResponse);

        $this->withresponseFactoryForValidResponse();

        return $this;
    }

    private function withresponseFactoryForValidResponse(): void
    {
        $this->responseFactory->method('create')
            ->willReturn(new ResponseProxy(200, 'Test content.'));

    }

    public function withInvalidValidatorResponse(): self
    {
        $validatorResponse = new ValidatorResponse(false, ['An error message.']);

        $this->validator->method('validate')
            ->willReturn($validatorResponse);

        $this->withresponseFactoryForInvalidResponse();

        return $this;
    }

    private function withresponseFactoryForInvalidResponse(): void
    {
        $this->responseFactory->method('create')
            ->willReturn(new ResponseProxy(422, 'An error message.'));
    }

    public function withRepositoryFactory() : self
    {
        $this->repositoryFactory->expects($this->any())
            ->method('create')
            ->with($this->isInstanceOf(Entity::class))
            ->willReturn(
                $this->createMock(Repository::class)
            );

        return $this;
    }

    public function build() : CreatorResponder
    {
        $this->withValidValidatorResponse()
            ->withRepositoryFactory();

        return new CreatorResponder(
            $this->validator,
            $this->repositoryFactory,
            $this->responseFactory
        );
    }
}
