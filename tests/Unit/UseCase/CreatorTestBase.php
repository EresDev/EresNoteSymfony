<?php

namespace EresNote\Tests\Unit\UseCase;

use EresNote\Domain\Service\Factory\EntityFactoryInterface;
use EresNote\Domain\Service\ResponderInterface;
use EresNote\Domain\Service\ValueObject\SimpleHttpResponse;
use EresNote\Domain\Service\ValueObject\SimpleHttpResponseInterface;
use EresNote\Domain\Entity\AbstractEntity;
use PHPUnit\Framework\TestCase;

abstract class CreatorTestBase extends TestCase
{
    protected $dummyRequestParameters = [];

    protected function getEntityFactory(AbstractEntity $entity)
    {
        $factoryMock = $this->createMock(
            EntityFactoryInterface::class
        );

        $factoryMock->expects($this->once())
            ->method('createFromParameters')
            ->willReturn($entity);

        return $factoryMock;
    }

    protected function getEntity(int $entity_id)
    {
        $entityStub = $this->createMock(AbstractEntity::class);

        $entityStub->method('getId')
            ->willReturn($entity_id);

        return $entityStub;
    }

    protected function getResponder(
        AbstractEntity $entity,
        SimpleHttpResponseInterface $simpleHttpResponse
    ){
        $responderMock = $this->createMock(ResponderInterface::class);

        $responderMock->expects($this->once())
            ->method('prepare')
            ->with($entity)
            ->willReturn($simpleHttpResponse);

        return $responderMock;
    }

    protected function getSimpleHttpResponse()
    {
        return new SimpleHttpResponse(200, 'Some test content!');
    }
}
