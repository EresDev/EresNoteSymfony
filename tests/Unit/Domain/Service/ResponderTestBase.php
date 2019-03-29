<?php

namespace EresNote\Tests\Unit\Domain\Service;

use EresNote\Domain\Entity\AbstractEntity;
use EresNote\Domain\Repository\RepositoryInterface;
use EresNote\Domain\Service\Factory\HttpResponseFactoryInterface;
use EresNote\Domain\Service\Responder;
use EresNote\Domain\Service\ValidatorInterface;
use EresNote\Domain\Service\ValueObject\SimpleHttpResponse;
use EresNote\Domain\Service\ValueObject\SimpleHttpResponseInterface;
use EresNote\Domain\Service\ValueObject\ValidatorResponse;
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
