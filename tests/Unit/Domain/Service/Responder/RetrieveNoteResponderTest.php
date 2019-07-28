<?php

namespace App\Tests\Unit\Domain\Service\Responder;

use App\Domain\Service\Responder\RetrieveNoteResponder;
use App\Domain\Service\ValueObject\HttpResponse;
use App\Tests\Extra\StubServices;
use App\Tests\Extra\ValidEntities;
use PHPUnit\Framework\TestCase;

class RetrieveNoteResponderTest extends TestCase
{
    public function testPrepareForValidNote() : void
    {
        $note = ValidEntities::getNote();
        $translator = StubServices::getTranslator('foo bar...');

        $responder = new RetrieveNoteResponder($translator);
        $response = $responder->prepare($note);

        $this->assertTrue(
            $response->equals(
                HttpResponse::fromObject(200, $note)
            )
        );
    }

    public function testPrepareForNullInPlaceOfNote() : void
    {
        $translator = StubServices::getTranslator('foo bar...');

        $responder = new RetrieveNoteResponder($translator);
        $response = $responder->prepare(null);

        $this->assertTrue(
            $response->equals(
                HttpResponse::fromString(404, 'foo bar...')
            )
        );
    }
}
