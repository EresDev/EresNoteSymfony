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
    private $httpResponseFactory;
    private $successHook;

    public function __construct(
        Validator $validator,
        HttpResponseFactory $httpResponseFactory,
        CreateUserSuccessHook $successHook
    ){
        $this->validator = $validator;
        $this->httpResponseFactory = $httpResponseFactory;
        $this->successHook = $successHook;
    }

    public function prepare(Entity $entity) : HttpResponse
    {
        $validatorResponse = $this->validator->validate($entity);

        if ($validatorResponse->isValid()) {
            $user = $this->successHook->process($entity);

            return $this->getSuccessResponse($user);
        }

        return $this->getFailureResponse($validatorResponse->getErrors());
    }

    protected function getSuccessResponse(Entity $entity): HttpResponse
    {
        $response = $this->httpResponseFactory->create(200, $entity);
        return $response;
    }

    protected function getFailureResponse(array $errors): HttpResponse
    {
        $response = $this->httpResponseFactory->create(422, $errors);
        return $response;
    }
}
