<?php

namespace App\Domain\Service\Responder;

use App\Domain\Entity\Entity;
use App\Domain\Service\CreateUserSuccessHook;
use App\Domain\Service\Factory\HttpResponseFactory;
use App\Domain\Service\Validator;
use App\Domain\Service\ValueObject\HttpResponse;

class CreateUserResponder implements Responder
{
    private $validator;
    private $successHook;

    public function __construct(
        Validator $validator,
        CreateUserSuccessHook $successHook
    ){
        $this->validator = $validator;
        $this->successHook = $successHook;
    }

    public function prepare(Entity $entity) : HttpResponse
    {
        $validatorResponse = $this->validator->validate($entity);

        if ($validatorResponse->isValid()) {
            // TODO: http response factory gone, bring saver here
            // instead of saving in success hook
            $this->successHook->process($entity);

            return HttpResponse::fromObject(200, $entity);
        }

        return HttpResponse::fromArray(422, $validatorResponse->getErrors());
    }
}
