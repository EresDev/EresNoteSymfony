<?php


namespace EresNote\Domain\Service;


interface SerializerInterface
{
    public function serialize($data): string;
}
