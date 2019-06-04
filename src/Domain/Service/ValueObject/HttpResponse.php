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
}
