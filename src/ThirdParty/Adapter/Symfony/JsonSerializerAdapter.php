<?php
namespace EresNote\ThirdParty\Adapter\Symfony;

use EresNote\Domain\Service\SerializerInterface;
use Symfony\Component\Serializer\SerializerInterface as SymfonySerializerInterface;

class JsonSerializerAdapter implements SerializerInterface
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
