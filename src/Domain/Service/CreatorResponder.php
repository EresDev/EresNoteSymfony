<?php

namespace App\Domain\Service;

use App\Domain\Entity\AbstractEntity;
use App\Domain\Service\Factory\HttpResponseFactoryInterface;
use App\Domain\Service\Factory\RepositoryFactoryInterface;
use App\Domain\Service\ValueObject\SimpleHttpResponse;
use App\Domain\Service\ValueObject\SimpleHttpResponseInterface;

class CreatorResponder implements ResponderInterface
{
    private $validator;
    private $repositoryFactory;

    public function __construct(
        ValidatorInterface $validator,
        RepositoryFactoryInterface $repositoryFactory
    ){
        $this->validator = $validator;
        $this->repositoryFactory = $repositoryFactory;
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
        return new SimpleHttpResponse(200, $entity);
    }

    protected function getFailureResponse(array $errors): SimpleHttpResponseInterface
    {
        return new SimpleHttpResponse(422, $errors);
    }
}
