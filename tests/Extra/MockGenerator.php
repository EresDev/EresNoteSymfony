<?php

namespace App\Tests\Extra;

use PHPUnit\Framework\MockObject\Generator;

class MockGenerator
{
    public static function get() : Generator
    {
        return new Generator();
    }
}
