<?php

namespace App\Domain\UseCase;

use App\Domain\Service\Factory\EntityFactory;
use App\Domain\Service\Responder\Responder;
use App\Domain\Service\ValueObject\HttpResponse;

abstract class CreateUseCase implements UseCase
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

    public function execute($requestParameters) : HttpResponse
    {
        $entity = $this->entityFactory->createFromParameters($requestParameters);
        $response = $this->responder->prepare($entity);

        return $response;
    }
}
