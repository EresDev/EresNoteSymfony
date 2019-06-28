<?php

namespace App\Tests\Unit\Domain\Service\Responder;

use App\Domain\Service\Responder\RetrieveNoteResponder;
use App\Domain\Service\ValueObject\HttpResponse;
use App\Tests\Extra\StubFactories;
use App\Tests\Extra\StubServices;
use PHPUnit\Framework\TestCase;

class RetrieveNoteResponderBuilder extends TestCase
{
    private $translator;
    private $httpResponseFactory;

    public static function getInstance(): self
    {
        return new static();
    }

    public function build() : RetrieveNoteResponder
    {
        if ($this->httpResponseFactory == null) {
            throw new \UnexpectedValueException(
                'HttpResponseFactory must be set before build.'
            );
        }

        return new RetrieveNoteResponder(
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
