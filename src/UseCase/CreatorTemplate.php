<?php

namespace EresNote\UseCase;

use EresNote\Domain\Entity\AbstractEntity;
use EresNote\Domain\Repository\RepositoryInterface;
use EresNote\Domain\Service\Factory\HttpResponseFactoryInterface;
use EresNote\Domain\Service\SerializerInterface;
use EresNote\Domain\Service\ValidatorInterface;
use EresNote\Domain\Service\ValueObject\SimpleHttpResponseInterface;

abstract class CreatorTemplate
{
    private $validator;
    private $repository;
    protected $httpResponseFactory;

    public function __construct(
        ValidatorInterface $validator,
        RepositoryInterface $repository,
        HttpResponseFactoryInterface $httpResponseFactory
    ){
        $this->validator = $validator;
        $this->repository = $repository;
        $this->httpResponseFactory = $httpResponseFactory;
    }

    public function execute(array $requestParameters) : SimpleHttpResponseInterface {

        $factory = $this->getEntityFactory();
        $entity = $factory::createFromParameters($requestParameters);

        $validatorResponse = $this->validator->validate($entity);
        if ($validatorResponse->isValid()) {
            $this->processPreSuccessHook();
            $this->repository->persist($entity);

            return $this->getSuccessResponse($entity);
        }

        return $this->getFailureResponse($validatorResponse->getErrors());
    }

    abstract protected function getEntityFactory() : string;

    protected function processPreSuccessHook() : void
    {
    }

    abstract protected function getSuccessResponse(AbstractEntity $entity) : SimpleHttpResponseInterface;

    abstract protected function getFailureResponse(array $errors) : SimpleHttpResponseInterface;
}
