<?php

namespace App\Domain\Service\Factory;

use App\Domain\Service\ValueObject\HttpResponse;

interface HttpResponseFactory
{
    public function create(int $httpStatusCode, $data) : HttpResponse;
}
