<?php

namespace App\Tests\Extra;

use App\Domain\Service\Responder\Responder;
use App\Domain\Service\ValueObject\HttpResponse;

class StubServices
{
    use MockGeneratorTrait;

    public static function getResponder(HttpResponse $httpResponse): Responder
    {
        $responder = self::getStubGenerator()
            ->getMock(Responder::class);

        $responder->method('prepare')
            ->willReturn($httpResponse);

        return $responder;
    }
}
