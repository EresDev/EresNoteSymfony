<?php

namespace App\Domain\Service\Responder;

use App\Domain\Entity\Entity;
use App\Domain\Service\Factory\HttpResponseFactory;
use App\Domain\Service\Validator;
use App\Domain\Service\ValueObject\HttpResponse;

abstract class CreateEntityResponderTemplate implements Responder
{
    private $validator;
    private $httpResponseFactory;

    public function __construct(
        Validator $validator,
        HttpResponseFactory $httpResponseFactory
    ){
        $this->validator = $validator;
        $this->httpResponseFactory = $httpResponseFactory;
    }

    public function prepare(Entity $entity) : HttpResponse
    {
        $validatorResponse = $this->validator->validate($entity);

        if ($validatorResponse->isValid()) {
            $this->save($entity);

            return $this->getSuccessResponse($entity);
        }

        return $this->getFailureResponse($validatorResponse->getErrors());
    }


    abstract protected function save(Entity $entity): void ;

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
