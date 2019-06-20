<?php

namespace App\Tests\Unit\Domain\Service\Responder;

use App\Domain\Service\Responder\DeleteNoteResponder;
use App\Tests\Extra\StubFactories;
use App\Tests\Extra\ValidValues;
use PHPUnit\Framework\TestCase;

class DeleteNoteResponderTest extends TestCase
{
    private const HTTP_STATUS_CODE = 200;
    private const CONTENT = 'Some content.';

    public function testPrepareForDeletedNote() : void
    {
        $httpResponse = ValidValues::getHttpResponse(
            self::HTTP_STATUS_CODE,
            self::CONTENT
        );

        $httpResponseFactory = StubFactories::getHttpResponseFactory($httpResponse);

        $responder = new DeleteNoteResponder($httpResponseFactory);
        $response = $responder->prepare(true);

        $this->assertTrue($httpResponse->equals($response));
    }
}
