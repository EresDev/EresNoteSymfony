<?php

namespace App\Tests\Unit\Domain\Service;

use App\Domain\Entity\AbstractEntity;
use App\Domain\Repository\RepositoryInterface;
use App\Domain\Service\CreatorResponder;
use App\Domain\Service\Factory\RepositoryFactoryInterface;
use App\Domain\Service\ValidatorInterface;
use App\Domain\Service\ValueObject\ValidatorResponse;
use PHPUnit\Framework\TestCase;

class CreatorResponderBuilder extends TestCase
{
    private $validator;
    private $repositoryFactory;

    public static function getInstance(): CreatorResponderBuilder
    {
        return new self();
    }

    public function __construct()
    {
        $this->validator = $this->createMock(ValidatorInterface::class);
        $this->repositoryFactory = $this->createMock(
            RepositoryFactoryInterface::class
        );
        $this->withValidValidatorResponse();
        $this->withRepositoryFactory();
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
        $validatorResponse = new ValidatorResponse(false, ['This is a test error.']);

        $this->validator->method('validate')
            ->willReturn($validatorResponse);

        return $this;
    }

    public function withRepositoryFactory() : self
    {
        $this->repositoryFactory->expects($this->any())
            ->method('create')
            ->with($this->isInstanceOf(AbstractEntity::class))
            ->willReturn(
                $this->createMock(RepositoryInterface::class)
            );

        return $this;
    }

    public function build() : CreatorResponder
    {
        return new CreatorResponder(
            $this->validator,
            $this->repositoryFactory
        );
    }
}
