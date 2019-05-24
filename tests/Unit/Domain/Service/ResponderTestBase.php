<?php

namespace App\Tests\Unit\Domain\Service;

use App\Domain\Entity\AbstractEntity;
use App\Domain\Repository\RepositoryInterface;
use App\Domain\Service\Factory\HttpResponseFactoryInterface;
use App\Domain\Service\Factory\RepositoryFactoryInterface;
use App\Domain\Service\Responder;
use App\Domain\Service\ValidatorInterface;
use App\Domain\Service\ValueObject\SimpleHttpResponse;
use App\Domain\Service\ValueObject\SimpleHttpResponseInterface;
use App\Domain\Service\ValueObject\ValidatorResponse;
use PHPUnit\Framework\TestCase;

class ResponderTestBase extends TestCase
{
    protected $responseContent = 'some random content string!';
    protected $validStatusCode = 200;
    protected $invalidStatusCode = 422;

    protected function getValidator(bool $isValid, $content)
    {
        $validatorWithValidResponseStub = $this->createMock(
            ValidatorInterface::class
        );

        $validatorResponse = new ValidatorResponse($isValid, $content);

        $validatorWithValidResponseStub->method('validate')
            ->willReturn($validatorResponse);

        return $validatorWithValidResponseStub;

    }

    protected function getEntity()
    {
        $entityStub = $this->createMock(
            AbstractEntity::class
        );

        $entityStub->method('getId')
            ->willReturn(1);

        return $entityStub;
    }

    protected function getRepositoryFactory()
    {
        $repositoryMock = $this->createMock(
            RepositoryFactoryInterface::class
        );

        $repositoryMock->expects($this->any())
            ->method('create')
            ->with($this->isInstanceOf(AbstractEntity::class))
            ->willReturn($this->getRepository());

        return $repositoryMock;
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

    protected function getHttpResponseFactory(int $httpStatusCode, $content)
    {
        $httpResponseFactoryStub = $this->createMock(
            HttpResponseFactoryInterface::class
        );

        if (!is_string($content)) {
            $content = json_encode($content);
        }

        $httpResponseFactoryStub->method('create')
            ->willReturn($this->getSimpleHttpResponse($httpStatusCode, $content));

        return $httpResponseFactoryStub;
    }

    protected function getSimpleHttpResponse(int $httpStatusCode, $content)
    {
        return new SimpleHttpResponse($httpStatusCode, $content);
    }
}
