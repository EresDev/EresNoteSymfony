<?php

namespace App\Tests\Unit\Domain\UseCase;

use App\Domain\Service\Factory\EntityFactory;
use App\Domain\Service\Responder\Responder;
use App\Domain\Service\ValueObject\HttpResponse;
use App\Domain\Entity\Entity;
use PHPUnit\Framework\TestCase;

abstract class CreatorTestBase extends TestCase
{
    protected $dummyRequestParameters = [];

    protected function getEntityFactory(Entity $entity)
    {
        $factoryMock = $this->createMock(
            EntityFactory::class
        );

        $factoryMock->expects($this->once())
            ->method('createFromParameters')
            ->willReturn($entity);

        return $factoryMock;
    }

    protected function getEntity(int $entity_id)
    {
        $entityStub = $this->createMock(Entity::class);

        $entityStub->method('getId')
            ->willReturn($entity_id);

        return $entityStub;
    }

    protected function getResponder(
        Entity $entity,
        HttpResponse $simpleHttpResponse
    ){
        $responderMock = $this->createMock(Responder::class);

        $responderMock->expects($this->once())
            ->method('prepare')
            ->with($entity)
            ->willReturn($simpleHttpResponse);

        return $responderMock;
    }

    protected function getSimpleHttpResponse()
    {
        return new HttpResponse(200, 'Some test content!');
    }
}
