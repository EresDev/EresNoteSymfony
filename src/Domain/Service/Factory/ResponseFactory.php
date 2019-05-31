<?php

namespace App\Domain\Service\Factory;

use App\Domain\Service\Http\Response;

interface ResponseFactory
{
    public function create(int $httpStatusCode, $data) : Response;
}
