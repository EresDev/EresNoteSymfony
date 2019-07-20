<?php

namespace App\Domain\Exception;

use Throwable;

abstract class HttpException extends BaseException
{
    protected $httpStatusCode;

    public function __construct(
        int $httpStatusCode,
        string $message = "",
        int $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);

        $this->httpStatusCode = $httpStatusCode;
    }

    public function getHttpStatusCode(): int
    {
        return $this->httpStatusCode;
    }
}
