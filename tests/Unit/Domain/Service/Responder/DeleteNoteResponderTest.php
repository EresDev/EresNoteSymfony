<?php

namespace App\Tests\Unit\Domain\Service\Responder;

use App\Domain\Service\Responder\DeleteNoteResponder;
use App\Domain\Service\ValueObject\HttpResponse;
use App\Tests\Extra\StubFactories;
use App\Tests\Extra\StubServices;
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
        $translator = StubServices::getTranslator(self::CONTENT);
        $note = ValidEntities::getNote();

        $responder = new DeleteNoteResponder($translator);
        $response = $responder->prepare($note);

        $this->assertTrue(
            $response->equals(
                HttpResponse::fromString(self::HTTP_SUCCESS, self::CONTENT)
            )
        );
    }

    public function testPrepareForNonExistingNote() : void
    {
        $translator = StubServices::getTranslator(self::CONTENT);
        $note = ValidEntities::getNote();

        $responder = new DeleteNoteResponder($translator);
        $response = $responder->prepare(null);

        $this->assertTrue(
            $response->equals(
                HttpResponse::fromString(self::HTTP_FAILURE, self::CONTENT)
            )
        );
    }
}
