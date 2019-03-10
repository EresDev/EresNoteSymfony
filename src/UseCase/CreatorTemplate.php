<?php

namespace EresNote\UseCase;

use EresNote\Domain\Entity\AbstractEntity;
use EresNote\Domain\Repository\RepositoryInterface;
use EresNote\Domain\Service\ValidatorInterface;
use EresNote\Domain\Service\ValueObject\SimpleResponseInterface;

abstract class CreatorTemplate
{
    private $validator;
    private $repository;

    public function __construct(ValidatorInterface $validator, RepositoryInterface $repository)
    {
        $this->validator = $validator;
        $this->repository = $repository;
    }

    public function execute(array $requestParameters) : SimpleResponseInterface {

        $factory = $this->getEntityFactory();
        $entity = $factory::createFromParameters($requestParameters);

        $validatorResponse = $this->validator->validate($entity);
        if ($validatorResponse->isValid) {
            $this->processPreSuccessHook();
            $this->repository->persist($entity);

            return $this->getSuccessResponse($entity);
        }

        return $this->getFailureResponse($validatorResponse->errors);
    }

    abstract protected function getEntityFactory() : string;

    protected function processPreSuccessHook() : void
    {
    }

    abstract protected function getSuccessResponse(AbstractEntity $entity) : SimpleResponseInterface;

    abstract protected function getFailureResponse(array $errors) : SimpleResponseInterface;
}
