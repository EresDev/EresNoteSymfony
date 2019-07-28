<?php

namespace App\Domain\Service\ValueObject;

class HttpResponse
{
    /**
     * @var int
     */
    private $statusCode;
    /**
     * @var string
     */
    private $content;

    public function __construct(int $statusCode, string $content)
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

    public function equals(self $object): bool
    {
        return
            $object->getStatusCode() === $this->getStatusCode() &&
            $object->getContent()  === $this->getContent();
    }

    public static function fromString(int $statusCode, string $content) : self
    {
        return new self($statusCode, $content);
    }

    public static function fromObject(int $statusCode, object $content) : self
    {
        return self::fromString($statusCode, json_encode($content));
    }

    public static function fromArray(int $statusCode, array $content) : self
    {
        return self::fromString($statusCode, json_encode($content));
    }
}
