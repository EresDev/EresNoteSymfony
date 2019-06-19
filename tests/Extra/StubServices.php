<?php

namespace App\Tests\Extra;

use App\Domain\Entity\Entity;
use App\Domain\Repository\EntitySingleGetter;
use App\Domain\Service\Responder\Responder;
use App\Domain\Service\Translator;
use App\Domain\Service\ValueObject\HttpResponse;

class StubServices
{
    public static function getResponder(HttpResponse $httpResponse): Responder
    {
        $responder = MockGenerator::get()
            ->getMock(Responder::class);

        $responder->method('prepare')
            ->willReturn($httpResponse);

        return $responder;
    }

    public static function getEntitySingleGetter(Entity $entity) : EntitySingleGetter
    {
        $entitySingleGetter = MockGenerator::get()
            ->getMock(EntitySingleGetter::class);

        $entitySingleGetter->method('getById')
            ->willReturn($entity);

        return $entitySingleGetter;
    }

    public static function getTranslator(string $textToReturn) : Translator
    {
        $translator = MockGenerator::get()
            ->getMock(Translator::class);

        $translator->method('translate')
            ->willReturn($textToReturn);

        return $translator;
    }
}
