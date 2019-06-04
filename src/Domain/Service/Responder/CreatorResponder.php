<?php

namespace App\Domain\Service\Responder;

use App\Domain\Entity\Entity;
use App\Domain\Service\Factory\HttpResponseFactory;
use App\Domain\Service\Factory\RepositoryFactory;
use App\Domain\Service\Validator;
use App\Domain\Service\ValueObject\HttpResponse;

class CreatorResponder implements Responder
{
    private $validator;
    private $repositoryFactory;
    private $httpResponseFactory;

    public function __construct(
        Validator $validator,
        HttpResponseFactory $httpResponseFactory,
        RepositoryFactory $repositoryFactory
    ){
        $this->validator = $validator;
        $this->repositoryFactory = $repositoryFactory;
        $this->httpResponseFactory = $httpResponseFactory;
    }

    public function prepare(Entity $entity) : HttpResponse
    {
        $validatorResponse = $this->validator->validate($entity);
        if ($validatorResponse->isValid()) {

            $repository = $this->repositoryFactory->create($entity);
            $repository->persist($entity);

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
