<?php

namespace App\Domain\Service\Responder;

use App\Domain\Entity\Entity;
use App\Domain\Repository\EntityUpdater;
use App\Domain\Service\Validator;

class UpdateNoteResponder extends CreateEntityResponderTemplate
{
    private $entityUpdater;

    public function __construct(
        Validator $validator,
        EntityUpdater $entityUpdater
    ){
        parent::__construct($validator);

        $this->entityUpdater = $entityUpdater;
    }

    protected function save(Entity $entity): void
    {
        $this->entityUpdater->update($entity);
    }
}
