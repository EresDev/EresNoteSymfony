<?php

namespace App\UseCase;

use App\Domain\Service\Factory\EntityFactory;
use App\Domain\Service\Http\Response;
use App\Domain\Service\Responder;

abstract class CreatorTemplate implements UseCase
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

    public function execute(array $requestParameters) : Response
    {
        $entity = $this->entityFactory->createFromParameters($requestParameters);
        $response = $this->responder->prepare($entity);

        return $response;
    }
}
