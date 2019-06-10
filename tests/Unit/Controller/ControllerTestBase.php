<?php

namespace App\Tests\Unit\Controller;

use App\Domain\Service\ValueObject\HttpResponse;
use App\Domain\UseCase\UseCase;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ControllerTestBase extends TestCase
{
    protected const STATUS_CODE = 200;
    protected const CONTENT = 'Some content.';

    protected function getUseCase() : MockObject
    {
        $useCase = $this->createMock(UseCase::class);
        $useCase->expects($this->any())
            ->method('execute')
            ->willReturn(new HttpResponse(self::STATUS_CODE, self::CONTENT));

        return $useCase;
    }
}
