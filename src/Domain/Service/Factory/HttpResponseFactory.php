<?php


namespace EresNote\Domain\Service\Factory;


use EresNote\Domain\Service\SerializerInterface;
use EresNote\Domain\Service\ValueObject\SimpleHttpResponse;
use EresNote\Domain\Service\ValueObject\SimpleHttpResponseInterface;

class HttpResponseFactory implements HttpResponseFactoryInterface
{
    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function create(int $httpStatusCode, $data): SimpleHttpResponseInterface
    {
        if (!$this->isValid($httpStatusCode)) {
            throw new InvalidArgumentException(
                "Http status code is not valid. Got {$httpStatusCode}."
            );
        }

        if (!is_string($data)) {
            $data = $this->convertToString($data);
        }

        $simpleHttpResponse = new SimpleHttpResponse($httpStatusCode, $data);

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
