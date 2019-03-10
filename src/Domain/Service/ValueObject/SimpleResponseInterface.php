<?php


namespace EresNote\Domain\Service\ValueObject;


interface SimpleResponseInterface
{
    public function getStatusCode(): int ;
    public function getContent() : string;
}
