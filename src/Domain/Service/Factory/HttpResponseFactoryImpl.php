<?php

namespace App\Domain\Service\Factory;

use App\Domain\Service\Serializer;
use App\Domain\Service\ValueObject\HttpResponse;

class HttpResponseFactoryImpl implements HttpResponseFactory
{
    private $serializer;

    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    public function create(int $httpStatusCode, $data): HttpResponse
    {
        if (!$this->isValid($httpStatusCode)) {
            throw new InvalidArgumentException(
                "Http status code is not valid. Got {$httpStatusCode}."
            );
        }

        if (!is_string($data)) {
            $data = $this->convertToString($data);
        }

        $simpleHttpResponse = new HttpResponse($httpStatusCode, $data);

        return $simpleHttpResponse;
    }


    private function isValid(int $httpStatusCode) : bool
    {
        return ($httpStatusCode >= 100 && $httpStatusCode <= 599);
    }

    private function convertToString($data) : string
    {
        return $this->serializer->serialize($data);
    }
}
