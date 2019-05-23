<?php

namespace App\Domain\Service\ValueObject;

use App\Domain\Service\SerializerInterface;
use http\Exception\InvalidArgumentException;


class SimpleHttpResponse implements SimpleHttpResponseInterface
{
    private $statusCode;
    private $content;

    public function __construct(int $statusCode, $content)
    {
        $this->statusCode = $statusCode;
        $this->content = $content;
    }


    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getContent() : string
    {
        return $this->content;
    }
}
