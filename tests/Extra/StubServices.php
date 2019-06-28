<?php

namespace App\Tests\Extra;

use App\Domain\Entity\Entity;
use App\Domain\Repository\EntityDeleter;
use App\Domain\Repository\EntitySingleGetter;
use App\Domain\Service\Http\Request\PathVariableGetter;
use App\Domain\Service\Responder\Responder;
use App\Domain\Service\Translator;
use App\Domain\Service\ValueObject\HttpResponse;
use App\Domain\UseCase\CreateUseCase;
use App\Domain\UseCase\RetrieveUseCase;
use App\Domain\UseCase\UseCase;

class StubServices
{
    public static function getUseCase(HttpResponse $httpResponse) : UseCase
    {
        $useCase = MockGenerator::get()
            ->getMock(UseCase::class);

        $useCase->method('execute')
            ->willReturn($httpResponse);

        return $useCase;
    }

    public static function getCreateUseCase(HttpResponse $httpResponse) : CreateUseCase
    {
        $createUseCase = MockGenerator::get()
            ->getMock(CreateUseCase::class);

        $createUseCase->method('execute')
            ->willReturn($httpResponse);

        return $createUseCase;
    }

    public static function getRetrieveUseCase(HttpResponse $httpResponse) : RetrieveUseCase
    {
        $retrieveUseCase = MockGenerator::get()
            ->getMock(RetrieveUseCase::class);

        $retrieveUseCase->method('execute')
            ->willReturn($httpResponse);

        return $retrieveUseCase;
    }

    public static function getResponder(HttpResponse $httpResponse): Responder
    {
        $responder = MockGenerator::get()
            ->getMock(Responder::class);

        $responder->method('prepare')
            ->willReturn($httpResponse);

        return $responder;
    }

    public static function getTranslator(string $textToReturn) : Translator
    {
        $translator = MockGenerator::get()
            ->getMock(Translator::class);

        $translator->method('translate')
            ->willReturn($textToReturn);

        return $translator;
    }

    public static function getEntitySingleGetter(Entity $entity) : EntitySingleGetter
    {
        $entitySingleGetter = MockGenerator::get()
            ->getMock(EntitySingleGetter::class);

        $entitySingleGetter->method('getById')
            ->willReturn($entity);

        return $entitySingleGetter;
    }

    public static function getEntityDeleter(bool $valueToReturn) : EntityDeleter
    {
        $entityDeleter = MockGenerator::get()
            ->getMock(EntityDeleter::class);

        $entityDeleter->method('delete')
            ->willReturn($valueToReturn);

        return $entityDeleter;
    }

    public static function getPathVariableGetter(string $valueToReturn): PathVariableGetter
    {
        $pathVariableGetter = MockGenerator::get()
            ->getMock(PathVariableGetter::class);

        $pathVariableGetter->method('get')
            ->willReturn($valueToReturn);

        return $pathVariableGetter;
    }


}
