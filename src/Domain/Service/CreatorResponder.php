<?php

namespace App\Domain\Service;

use App\Domain\Entity\AbstractEntity;
use App\Domain\Service\Factory\HttpResponseFactory;
use App\Domain\Service\Factory\RepositoryFactory;
use App\Domain\Service\ValueObject\SimpleHttpResponseInterface;

class CreatorResponder implements Responder
{
    private $validator;
    private $repositoryFactory;
    private $httpResponseFactory;

    public function __construct(
        Validator $validator,
        RepositoryFactory $repositoryFactory,
        HttpResponseFactory $httpResponseFactory
    ){
        $this->validator = $validator;
        $this->repositoryFactory = $repositoryFactory;
        $this->httpResponseFactory = $httpResponseFactory;
    }

    public function prepare(AbstractEntity $entity) : SimpleHttpResponseInterface
    {
        $validatorResponse = $this->validator->validate($entity);
        if ($validatorResponse->isValid()) {

            $repository = $this->repositoryFactory->create($entity);
            $repository->persist($entity);

            return $this->getSuccessResponse($entity);
        }
        return $this->getFailureResponse($validatorResponse->getErrors());
    }

    protected function getSuccessResponse(AbstractEntity $entity): SimpleHttpResponseInterface
    {
        $response = $this->httpResponseFactory->create(200, $entity);
        return $response;
    }

    protected function getFailureResponse(array $errors): SimpleHttpResponseInterface
    {
        $response = $this->httpResponseFactory->create(422, $errors);
        return $response;
    }
}
