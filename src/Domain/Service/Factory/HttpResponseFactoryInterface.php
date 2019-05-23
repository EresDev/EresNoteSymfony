<?php
namespace App\Domain\Service\Factory;

use App\Domain\Service\ValueObject\SimpleHttpResponseInterface;

interface HttpResponseFactoryInterface
{
    public function create(int $httpStatusCode, $data) : SimpleHttpResponseInterface;
}
