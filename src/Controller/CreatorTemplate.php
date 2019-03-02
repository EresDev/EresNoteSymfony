<?php

namespace EresNote\Controller;

use EresNote\Domain\Repository\RepositoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;


abstract class CreatorTemplate
{
    public function create(
        Request $request,
        ValidatorInterface $validator,
        RepositoryInterface $repository
    ) : Response{
        $requestParameters = $request->request->all();
        $factory = $this->getFactory();
        $entity = $factory::createFromParameters($requestParameters);

        $constraintViolationList = $validator->validate($entity);
        if ($constraintViolationList->count() === 0) {
            $this->processPreSuccessHook();
            $repository->persist($entity);
            return $this->getSuccessResponse();
        }

        return $this->getFailureResponse($constraintViolationList);
    }

    abstract protected function getFactory() : string;

    protected function processPreSuccessHook() : void
    {

    }

    abstract protected function getSuccessResponse() : Response;

    abstract protected function getFailureResponse(
        ConstraintViolationListInterface $constraintViolationList
    ) : Response;
}
