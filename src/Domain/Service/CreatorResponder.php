<?php

namespace App\Domain\Service;

use App\Domain\Entity\Entity;
use App\Domain\Service\Factory\ResponseFactory;
use App\Domain\Service\Factory\RepositoryFactory;
use App\Domain\Service\Http\Response;

class CreatorResponder implements Responder
{
    private $validator;
    private $repositoryFactory;
    private $responseFactory;

    public function __construct(
        Validator $validator,
        RepositoryFactory $repositoryFactory,
        ResponseFactory $responseFactory
    ){
        $this->validator = $validator;
        $this->repositoryFactory = $repositoryFactory;
        $this->responseFactory = $responseFactory;
    }

    public function prepare(Entity $entity) : Response
    {
        $validatorResponse = $this->validator->validate($entity);
        if ($validatorResponse->isValid()) {

            $repository = $this->repositoryFactory->create($entity);
            $repository->persist($entity);

            return $this->getSuccessResponse($entity);
        }
        return $this->getFailureResponse($validatorResponse->getErrors());
    }

    protected function getSuccessResponse(Entity $entity): Response
    {
        $response = $this->responseFactory->create(200, $entity);
        return $response;
    }

    protected function getFailureResponse(array $errors): Response
    {
        $response = $this->responseFactory->create(422, $errors);
        return $response;
    }
}
