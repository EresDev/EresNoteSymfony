<?php


namespace EresNote\Domain\Service\ValueObject;

use EresNote\Domain\Service\ValueObject\SimpleResponseInterface;
use http\Exception\InvalidArgumentException;


class SimpleResponse implements SimpleResponseInterface
{
    private $statusCode;
    private $content;

    public function __construct(int $statusCode, $content)
    {
        if ($this->isValid($statusCode)) {
            $this->statusCode = $statusCode;
        } else {
            throw new InvalidArgumentException(
                "Http status code is not valid. Got {$statusCode}."
            );
        }

        if (!is_string($content)) {
            $this->content = json_encode($content);
        } else {
            $this->content = $content;
        }
    }

    private function isValid(int $httpStatusCode)
    {
        return ($httpStatusCode >= 100 && $httpStatusCode <= 599);
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getContent(): string
    {
        return $this->content;
    }
}
