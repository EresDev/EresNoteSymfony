<?php

namespace App\Tests\Extra;

use App\Domain\Entity\Entity;
use App\Domain\Service\Factory\EntityFactory;
use App\Domain\Service\Factory\HttpResponseFactory;
use App\Domain\Service\ValueObject\HttpResponse;
use PHPUnit\Framework\MockObject\MockObject;

class StubFactories
{
    use MockGeneratorTrait;

    public static function getEntityFactory(Entity $entity): EntityFactory
    {
        $entityFactory = self::getStubGenerator()
            ->getMock(EntityFactory::class);

        $entityFactory
            ->method('createFromParameters')
            ->willReturn($entity);

        return $entityFactory;
    }

    public static function getHttpResponseFactory(int $statusCode, $content): HttpResponseFactory
    {
        $httpResponseFactory = self::getStubGenerator()
            ->getMock(HttpResponseFactory::class);

        $httpResponseFactory
            ->method('create')
            ->willReturn(
                new HttpResponse($statusCode, $content)
            );

        return $httpResponseFactory;
    }
}
