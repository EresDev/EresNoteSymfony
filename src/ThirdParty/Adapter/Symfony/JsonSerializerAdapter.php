<?php

namespace App\ThirdParty\Adapter\Symfony;

use App\Domain\Service\Serializer;
use Symfony\Component\Serializer\SerializerInterface as SymfonySerializerInterface;

class JsonSerializerAdapter implements Serializer
{
    private $serializer;

    public function __construct(SymfonySerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function serialize($data) : string
    {
        $serializedJson = $this->serializer->serialize($data, 'json');
        return $serializedJson;
    }

}
