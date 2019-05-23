<?php


namespace App\Domain\Service\ValueObject;


interface SimpleHttpResponseInterface
{
    public function getStatusCode(): int ;
    public function getContent() : string;
}
