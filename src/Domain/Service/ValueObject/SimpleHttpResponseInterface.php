<?php


namespace EresNote\Domain\Service\ValueObject;


interface SimpleHttpResponseInterface
{
    public function getStatusCode(): int ;
    public function getContent() : string;
}
