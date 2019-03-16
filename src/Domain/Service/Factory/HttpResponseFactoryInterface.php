<?php


namespace EresNote\Domain\Service\Factory;


use EresNote\Domain\Service\ValueObject\SimpleHttpResponseInterface;

interface HttpResponseFactoryInterface
{
    public function create(int $httpStatusCode, $data) : SimpleHttpResponseInterface;
}
