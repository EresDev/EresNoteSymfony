<?php

namespace App\Tests\Extra;

use PHPUnit\Framework\MockObject\Generator;

trait MockGeneratorTrait
{
    private static function getStubGenerator() : Generator
    {
        return new Generator();
    }
}
