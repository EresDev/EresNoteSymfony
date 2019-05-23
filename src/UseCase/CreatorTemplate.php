<?php

namespace App\UseCase;

use App\Domain\Service\Factory\EntityFactoryInterface;
use App\Domain\Service\ResponderInterface;
use App\Domain\Service\ValueObject\SimpleHttpResponseInterface;

abstract class CreatorTemplate
{
    private $entityFactory;
    private $responder;

    public function __construct(
        EntityFactoryInterface $entityFactory,
        ResponderInterface $responder
    ){
        $this->entityFactory = $entityFactory;
        $this->responder = $responder;
    }

    public function execute(array $requestParameters) : SimpleHttpResponseInterface
    {
        $entity = $this->entityFactory->createFromParameters($requestParameters);
        $response = $this->responder->prepare($entity);

        return $response;
    }
}
