<?php

namespace App\Tests\Unit\Domain\Service\Responder;

use App\Domain\Service\Responder\NoteGetterResponder;
use App\Tests\Extra\StubFactories;
use App\Tests\Extra\StubServices;
use App\Tests\Extra\ValidEntities;
use App\Tests\Extra\ValidValues;
use PHPUnit\Framework\TestCase;

class NoteGetterResponderTest extends TestCase
{
    public function testPrepareForValidNote() : void
    {
        $note = ValidEntities::getNote();
        $responseForValidNote = ValidValues::getHttpResponse(200, $note);

        $noteGetterResponder = NoteGetterResponderBuilder::getInstance()
            ->withHttpResponse($responseForValidNote)
            ->build();

        $response = $noteGetterResponder->prepare($note);

        $this->assertTrue($responseForValidNote->equals($response));
    }

    public function testPrepareForNullInPlaceOfNote() : void
    {
        $responseForNull = ValidValues::getHttpResponse(
            404,
            'Resource not found.'
        );

        $noteGetterResponder = NoteGetterResponderBuilder::getInstance()
            ->withHttpResponse($responseForNull)
            ->build();

        $response = $noteGetterResponder->prepare(null);

        $this->assertTrue($responseForNull->equals($response));
    }
}
