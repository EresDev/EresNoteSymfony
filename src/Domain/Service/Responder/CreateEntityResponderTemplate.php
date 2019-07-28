<?php

namespace App\Domain\Service\Responder;

use App\Domain\Entity\Entity;
use App\Domain\Service\Validator;
use App\Domain\Service\ValueObject\HttpResponse;

abstract class CreateEntityResponderTemplate implements Responder
{
    private $validator;

    public function __construct(
        Validator $validator
    ){
        $this->validator = $validator;
    }

    public function prepare(Entity $entity) : HttpResponse
    {
        $validatorResponse = $this->validator->validate($entity);

        if ($validatorResponse->isValid()) {
            $this->save($entity);

            return HttpResponse::fromObject(200, $entity);
        }

        return HttpResponse::fromArray(422, $validatorResponse->getErrors());
    }

    abstract protected function save(Entity $entity): void ;
}
