<?php

namespace App\Tests\Unit\Domain\Service\Responder;

use App\Domain\Service\Responder\NoteGetterResponder;
use App\Domain\Service\ValueObject\HttpResponse;
use App\Tests\Extra\StubFactories;
use App\Tests\Extra\StubServices;
use App\Tests\Extra\ValidEntities;
use App\Tests\Extra\ValidValues;
use PHPUnit\Framework\TestCase;

class NoteGetterResponderBuilder extends TestCase
{
    private $translator;
    private $httpResponseFactory;

    public static function getInstance(): self
    {
        return new static();
    }

    public function build() : NoteGetterResponder
    {
        if ($this->httpResponseFactory == null) {
            throw new \UnexpectedValueException(
                'HttpResponseFactory must be set before build.'
            );
        }

        return new NoteGetterResponder(
            $this->translator,
            $this->httpResponseFactory
        );
    }

    public function __construct()
    {
        $this->withTranslatorReturning('Text after translation.');
    }

    public function withHttpResponse(HttpResponse $httpResponse) : self
    {
        $this->httpResponseFactory = StubFactories::getHttpResponseFactory($httpResponse);

        return $this;
    }

    public function withTranslatorReturning(string $textToReturn) : self
    {
        $this->translator =
            StubServices::getTranslator($textToReturn);

        return $this;
    }
}
