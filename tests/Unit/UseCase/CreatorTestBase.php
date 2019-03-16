<?php


namespace EresNote\Tests\Unit\UseCase;


use EresNote\Domain\Service\Factory\HttpResponseFactoryInterface;
use EresNote\Domain\Service\SerializerInterface;
use EresNote\Domain\Service\ValueObject\SimpleHttpResponseInterface;
use PHPUnit\Framework\TestCase;
use EresNote\Domain\Repository\RepositoryInterface;
use EresNote\Domain\Service\ValidatorInterface;
use EresNote\Domain\Service\ValueObject\ValidatorResponseInterface;
use EresNote\Domain\Entity\AbstractEntity;

abstract class CreatorTestBase extends TestCase
{
    protected $dummyRequestParameters = [];

    protected $responseContentForValidParameters = 'some random content string!';
    protected $responseContentForInvalidParameters = [
        'error1' => 'This is error 1.',
        'error2' => 'This is error 2'
    ];
    protected $validStatusCode = 200;
    protected $invalidStatusCode = 422;

    abstract public function testExecute_WithValidData();
    abstract public function testExecute_WithInvalidData();

    protected function getValidator(bool $isValid, $contentOrErrors)
    {
        $validatorWithValidResponseStub = $this->createMock(
            ValidatorInterface::class
        );

        $validValidatorResponse = $this->getValidValidatorResponse($isValid, $contentOrErrors);

        $validatorWithValidResponseStub->method('validate')
            ->willReturn($validValidatorResponse);

        return $validatorWithValidResponseStub;

    }

    protected function getValidValidatorResponse(bool $isValid, $contentOrErrors)
    {
        $validatorResponseStub = $this->createMock(
            ValidatorResponseInterface::class
        );

        $validatorResponseStub->method('isValid')
            ->willReturn($isValid);

        $validatorResponseStub->method('getErrors')
            ->willReturn($contentOrErrors);

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

    protected function getHttpResponseFactory(int $httpStatusCode, $contentOrErrors)
    {
        $serializerStub = $this->createMock(
            HttpResponseFactoryInterface::class
        );

        $serializerStub->method('create')
            ->willReturn($this->getSimpleHttpResponse($httpStatusCode, $contentOrErrors));

        return $serializerStub;
    }

    protected function getSimpleHttpResponse(int $httpStatusCode, $contentOrErrors)
    {
        $validSimpleHttpResponse = $this->createMock(
            SimpleHttpResponseInterface::class
        );

        if (!is_string($contentOrErrors)) {
            $contentOrErrors = json_encode($contentOrErrors);
        }

        $validSimpleHttpResponse->method('getStatusCode')
            ->willReturn($httpStatusCode);

        $validSimpleHttpResponse->method('getContent')
            ->willReturn($contentOrErrors);

        return $validSimpleHttpResponse;
    }
}
