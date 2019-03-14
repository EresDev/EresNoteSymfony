<?php


namespace EresNote\Tests\Unit\UseCase;


use PHPUnit\Framework\TestCase;
use EresNote\Domain\Repository\RepositoryInterface;
use EresNote\Domain\Service\ValidatorInterface;
use EresNote\Domain\Service\ValueObject\ValidatorResponseInterface;
use EresNote\Domain\Entity\AbstractEntity;

abstract class CreatorTestBase extends TestCase
{
    protected $dummyRequestParameters = [];

    protected $errorsForValidParameters = [];
    protected $validStatusCode = 200;

    protected $errorsForInvalidParameters = [
        'fieldName' => 'This is an error.',
        'anotherFieldName' => 'This is another error.'
    ];
    protected $invalidStatusCode = 422;

    abstract public function testExecute_WithValidData();

    protected function getValidatorWithValidResponse()
    {
        $validatorWithValidResponseStub = $this->createMock(
            ValidatorInterface::class
        );

        $validValidatorResponse = $this->getValidValidatorResponse();

        $validatorWithValidResponseStub->method('validate')
            ->willReturn($validValidatorResponse);

        return $validatorWithValidResponseStub;

    }

    protected function getValidValidatorResponse()
    {
        $validatorResponseStub = $this->createMock(
            ValidatorResponseInterface::class
        );

        $validatorResponseStub->method('isValid')
            ->willReturn(true);

        $validatorResponseStub->method('getErrors')
            ->willReturn($this->errorsForValidParameters);

        return $validatorResponseStub;
    }

    protected function getRepository()
    {
        $repositoryMock = $this->createMock(
            RepositoryInterface::class
        );

        $repositoryMock->expects($this->any())
            ->method('persist')
            ->with($this->isInstanceOf(AbstractEntity::class));

        return $repositoryMock;
    }

    protected function getValidatorWithInvalidResponse()
    {
        $validatorWithInvalidResponseStub = $this->createMock(
            ValidatorInterface::class
        );

        $InvalidValidatorResponse = $this->getInvalidValidatorResponse();

        $validatorWithInvalidResponseStub->method('validate')
            ->willReturn($InvalidValidatorResponse);

        return $validatorWithInvalidResponseStub;

    }


    protected function getInvalidValidatorResponse()
    {
        $validatorResponseStub = $this->createMock(
            ValidatorResponseInterface::class
        );

        $validatorResponseStub->method('isValid')
            ->willReturn(false);

        $validatorResponseStub->method('getErrors')
            ->willReturn($this->errorsForInvalidParameters);

        return $validatorResponseStub;
    }
}
