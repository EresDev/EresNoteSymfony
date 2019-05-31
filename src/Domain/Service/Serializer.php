<?php

namespace App\Domain\Service;

interface Serializer
{
    public function serialize($data): string;
}
