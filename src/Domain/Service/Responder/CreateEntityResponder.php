<?php

namespace App\Domain\Service\Responder;

use App\Domain\Entity\Entity;
use App\Domain\Repository\EntitySaver;
use App\Domain\Service\Factory\HttpResponseFactory;
use App\Domain\Service\Validator;
use App\Domain\Service\ValueObject\HttpResponse;

abstract class CreateEntityResponder implements Responder
{
    private $validator;
    private $httpResponseFactory;
    private $entitySaver;

    public function __construct(
        Validator $validator,
        HttpResponseFactory $httpResponseFactory,
        EntitySaver $entitySaver
    ){
        $this->validator = $validator;
        $this->httpResponseFactory = $httpResponseFactory;
        $this->entitySaver = $entitySaver;
    }

    public function prepare($entity) : HttpResponse
    {
        $validatorResponse = $this->validator->validate($entity);

        if ($validatorResponse->isValid()) {
            $this->entitySaver->save($entity);

            return $this->getSuccessResponse($entity);
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
