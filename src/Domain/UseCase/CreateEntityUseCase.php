<?php

namespace App\Domain\UseCase;

use App\Domain\Service\Factory\EntityFactory;
use App\Domain\Service\Responder\Responder;
use App\Domain\Service\ValueObject\HttpResponse;

abstract class CreateEntityUseCase implements UseCase
{
    protected $entityFactory;
    protected $responder;

    public function __construct(
        Responder $responder,
        EntityFactory $entityFactory
    ){
        $this->responder = $responder;
        $this->entityFactory = $entityFactory;
    }

    public function execute($requestParameters) : HttpResponse
    {
        $entity = $this->entityFactory->createFromParameters($requestParameters);

        return $this->responder->prepare($entity);
    }
}
