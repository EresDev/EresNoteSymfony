<?php

namespace App\Domain\Service\Responder;

use App\Domain\Entity\Entity;
use App\Domain\Repository\EntitySaver;
use App\Domain\Service\Factory\HttpResponseFactory;
use App\Domain\Service\Validator;

abstract class CreateEntityResponder extends CreateEntityResponderTemplate
{
    private $entitySaver;

    public function __construct(
        Validator $validator,
        HttpResponseFactory $httpResponseFactory,
        EntitySaver $entitySaver
    ){
        parent::__construct($validator, $httpResponseFactory);
        $this->entitySaver = $entitySaver;
    }

    protected function save(Entity $entity): void
    {
        $this->entitySaver->save($entity);
    }
}
