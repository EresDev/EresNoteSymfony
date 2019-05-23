<?php

namespace App\Tests\Unit\Domain\Service;

use App\Domain\Service\Responder;
use App\Domain\Service\ValueObject\SimpleHttpResponseInterface;

class ResponderTest extends ResponderTestBase
{
    public function testPrepare_withValid()
    {
        $validator = $this->getValidator(
            true,
            [$this->responseContent]
        );
        $repository = $this->getRepository();
        $entity = $this->getEntity();

        $httpResponseFactory = $this->getHttpResponseFactory(
            $this->validStatusCode,
            $this->responseContent
        );

        $responder = new Responder($validator, $repository, $httpResponseFactory);
        $response = $responder->prepare($entity);

        $this->assertInstanceOf(SimpleHttpResponseInterface::class, $response);
        $this->assertEquals($this->validStatusCode, $response->getStatusCode());
        $this->assertEquals(
            $this->responseContent,
            $response->getContent()
        );
    }


    public function testPrepare_withInvalid()
    {
        $validator = $this->getValidator(
            false,
            [$this->responseContent]
        );
        $repository = $this->getRepository();
        $entity = $this->getEntity();

        $httpResponseFactory = $this->getHttpResponseFactory(
            $this->invalidStatusCode,
            $this->responseContent
        );

        $responder = new Responder($validator, $repository, $httpResponseFactory);
        $response = $responder->prepare($entity);

        $this->assertInstanceOf(SimpleHttpResponseInterface::class, $response);
        $this->assertEquals($this->invalidStatusCode, $response->getStatusCode());
        $this->assertEquals(
            $this->responseContent,
            $response->getContent()
        );
    }
}
