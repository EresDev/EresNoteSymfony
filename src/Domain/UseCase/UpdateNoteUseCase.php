<?php

namespace App\Domain\UseCase;

use App\Domain\Service\Factory\EntityFactory;
use App\Domain\Service\Responder\Responder;
use App\Domain\Service\Security\Ownership;
use App\Domain\Service\ValueObject\HttpResponse;

class UpdateNoteUseCase implements CreateUseCase
{
    private $responder;
    private $entityFactory;
    private $ownership;

    public function __construct(
        Responder $responder,
        EntityFactory $entityFactory,
        Ownership $ownership
    ){
        $this->responder = $responder;
        $this->entityFactory = $entityFactory;
        $this->ownership = $ownership;
    }

    public function execute(array $requestParameters) : HttpResponse
    {
        if (! array_key_exists('id', $requestParameters)) {
            //throw InvalidRequest::fromParameters($requestParameters, 'id');
        }

        $this->ownership->check($requestParameters['id']);

        $entity = $this->entityFactory->createFromParameters($requestParameters);

        return $this->responder->prepare($entity);
    }
}
