<?php

namespace App\Tests\Unit\UseCase;

use App\Domain\Service\Factory\EntityFactory;
use App\Domain\Service\Http\Response;
use App\Domain\Service\Responder;
use App\Domain\Entity\Entity;
use App\ThirdParty\Proxy\ResponseProxy;
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
        Response $response
    ){
        $responderMock = $this->createMock(Responder::class);

        $responderMock->expects($this->once())
            ->method('prepare')
            ->with($entity)
            ->willReturn($response);

        return $responderMock;
    }

    protected function getResponse()
    {
        return new ResponseProxy(200, 'Some test content!');
    }
}
