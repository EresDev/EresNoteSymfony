<?php

namespace App\Domain\Service\Factory;

use App\Domain\Service\Http\Response;
use App\Domain\Service\Serializer;
use App\ThirdParty\Proxy\ResponseProxy;

class ResponseFactoryImpl implements ResponseFactory
{
    private $serializer;

    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    public function create(int $httpStatusCode, $data): Response
    {
        if (!$this->isValid($httpStatusCode)) {
            throw new InvalidArgumentException(
                "Http status code is not valid. Got {$httpStatusCode}."
            );
        }

        if (!is_string($data)) {
            $data = $this->convertToString($data);
        }

        $response = new ResponseProxy($httpStatusCode, $data);

        return $response;
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
