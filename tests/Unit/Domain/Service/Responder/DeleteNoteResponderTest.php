<?php

namespace App\Tests\Unit\Domain\Service\Responder;

use App\Domain\Service\Responder\DeleteNoteResponder;
use App\Tests\Extra\StubFactories;
use App\Tests\Extra\ValidEntities;
use App\Tests\Extra\ValidValues;
use PHPUnit\Framework\TestCase;

class DeleteNoteResponderTest extends TestCase
{
    private const HTTP_SUCCESS = 200;
    private const CONTENT = 'Some content.';

    private const HTTP_FAILURE = 404;

    public function testPrepareForExistingNote() : void
    {
        $httpResponse = ValidValues::getHttpResponse(
            self::HTTP_SUCCESS,
            self::CONTENT
        );

        $httpResponseFactory = StubFactories::getHttpResponseFactory($httpResponse);

        $responder = new DeleteNoteResponder($httpResponseFactory);
        $response = $responder->prepare(
            ValidEntities::getNote()
        );

        $this->assertTrue($httpResponse->equals($response));
    }

    public function testPrepareForNonExistingNote() : void
    {
        $httpResponse = ValidValues::getHttpResponse(
            self::HTTP_FAILURE,
            self::CONTENT
        );

        $httpResponseFactory = StubFactories::getHttpResponseFactory($httpResponse);

        $responder = new DeleteNoteResponder($httpResponseFactory);
        $response = $responder->prepare(null);

        $this->assertTrue($httpResponse->equals($response));
    }
}
