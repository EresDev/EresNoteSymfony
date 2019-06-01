<?php

namespace App\UseCase;

use App\Domain\Service\Factory\EntityFactory;
use App\Domain\Service\Responder;
use App\Domain\Service\ValueObject\HttpResponse;

abstract class CreatorTemplate
{
    private $entityFactory;
    private $responder;

    public function __construct(
        EntityFactory $entityFactory,
        Responder $responder
    ){
        $this->entityFactory = $entityFactory;
        $this->responder = $responder;
    }

    public function execute(array $requestParameters) : HttpResponse
    {
        $entity = $this->entityFactory->createFromParameters($requestParameters);
        $response = $this->responder->prepare($entity);

        return $response;
    }
}
