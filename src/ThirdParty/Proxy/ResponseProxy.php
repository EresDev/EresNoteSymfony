<?php

namespace App\ThirdParty\Proxy;

use App\Domain\Service\Http\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class ResponseProxy extends JsonResponse implements Response
{
    public function __construct(int $statusCode, string $content) {
        parent::__construct($content, $statusCode, [], true);
    }

    public function getContent(): string
    {
        return parent::getContent();
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
