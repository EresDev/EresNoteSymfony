<?php

namespace App\Domain\Service\Responder;

use App\Domain\Entity\Entity;
use App\Domain\Repository\EntityUpdater;
use App\Domain\Service\Factory\HttpResponseFactory;
use App\Domain\Service\Validator;

class UpdateNoteResponder extends CreateEntityResponderTemplate
{
    private $entityUpdater;

    public function __construct(
        Validator $validator,
        HttpResponseFactory $httpResponseFactory,
        EntityUpdater $entityUpdater
    ){
        parent::__construct($validator, $httpResponseFactory);

        $this->entityUpdater = $entityUpdater;
    }

    protected function save(Entity $entity): void
    {
        $this->entityUpdater->update($entity);
    }
}
