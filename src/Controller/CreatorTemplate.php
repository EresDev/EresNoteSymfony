<?php

namespace EresNote\Controller;

use EresNote\Domain\Entity\AbstractEntity;
use EresNote\Domain\Repository\RepositoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;


abstract class CreatorTemplate
{
    protected $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function create(
        Request $request,
        ValidatorInterface $validator,
        RepositoryInterface $repository
    ) : JsonResponse{
        $requestParameters = $request->request->all();
        $factory = $this->getFactory();
        $entity = $factory::createFromParameters($requestParameters);

        $constraintViolationList = $validator->validate($entity);
        if ($constraintViolationList->count() === 0) {
            $this->processPreSuccessHook();
            $repository->persist($entity);
            return $this->getSuccessResponse($entity);
        }

        return $this->getFailureResponse($constraintViolationList);
    }

    abstract protected function getFactory() : string;

    protected function processPreSuccessHook() : void
    {
    }

    abstract protected function getSuccessResponse(AbstractEntity $entity) : JsonResponse;

    abstract protected function getFailureResponse(
        ConstraintViolationListInterface $constraintViolationList
    ) : JsonResponse;
}
