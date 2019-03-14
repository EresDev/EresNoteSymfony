<?php


namespace EresNote\ThirdParty\Adapter\Symfony;


use EresNote\Domain\Service\SerializerInterface;


use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\SerializerInterface as SymfonySerializerInterface;

class JsonSerializerAdapter implements SerializerInterface
{
    private $serializer;

    public function __construct(SymfonySerializerInterface $serializer)
    {
        $encoders = [new JsonEncoder()];
//        $normalizers = [new ObjectNormalizer()];

        $this->serializer = $serializer; //new Serializer($normalizers, $encoders);
        //$this->serializer->supportsEncoding($encoders);
    }

    public function serialize($data): string
    {
        return $this->serializer->serialize($data, 'json');
    }
}
