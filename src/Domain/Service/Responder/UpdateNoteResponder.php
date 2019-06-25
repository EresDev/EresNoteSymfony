<?php

namespace App\Domain\Service\Responder;

use App\Domain\Entity\Entity;
use App\Domain\Repository\EntityUpdater;
use App\Domain\Service\Factory\HttpResponseFactory;
use App\Domain\Service\Validator;

class UpdateNoteResponder extends CreateNoteResponder
{
    private $entityUpdater;

    public function __construct(
        Validator $validator,
        HttpResponseFactory $httpResponseFactory,
        EntityUpdater $entityUpdater
    ){
        $this->validator = $validator;
        $this->httpResponseFactory = $httpResponseFactory;
        $this->entityUpdater = $entityUpdater;
    }

    protected function save(Entity $entity): void
    {
        $this->entityUpdater->update($entity);
    }
}
