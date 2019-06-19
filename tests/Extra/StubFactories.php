<?php

namespace App\Tests\Extra;

use App\Domain\Entity\Entity;
use App\Domain\Service\Factory\EntityFactory;
use App\Domain\Service\Factory\HttpResponseFactory;
use App\Domain\Service\ValueObject\HttpResponse;

class StubFactories
{
    public static function getEntityFactory(Entity $entity): EntityFactory
    {
        $entityFactory = MockGenerator::get()
            ->getMock(EntityFactory::class);

        $entityFactory
            ->method('createFromParameters')
            ->willReturn($entity);

        return $entityFactory;
    }

    public static function getHttpResponseFactory(HttpResponse $httpResponse): HttpResponseFactory
    {
        $httpResponseFactory = MockGenerator::get()
            ->getMock(HttpResponseFactory::class);

        $httpResponseFactory
            ->method('create')
            ->willReturn(
                $httpResponse
            );

        return $httpResponseFactory;
    }
}
