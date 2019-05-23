<?php
namespace App\Domain\Service;


interface SerializerInterface
{
    public function serialize($data): string;
}
