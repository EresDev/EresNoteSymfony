<?php
namespace App\Domain\Service\Factory;

use App\Domain\Service\ValueObject\SimpleHttpResponseInterface;

interface HttpResponseFactory
{
    public function create(int $httpStatusCode, $data) : SimpleHttpResponseInterface;
}
