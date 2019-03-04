<?php

namespace EresNote\Controller;

use EresNote\Domain\Entity\AbstractEntity;
use EresNote\Domain\Service\Factory\NoteFactory;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class NoteCreatorController extends CreatorTemplate
{
    protected function getFactory() : string
    {
        return NoteFactory::class;
    }

    protected function getSuccessResponse(AbstractEntity $entity): JsonResponse
    {
        return new JsonResponse($entity, JsonResponse::HTTP_OK);
    }

    protected function getFailureResponse(
        ConstraintViolationListInterface $constraintViolationList
    ) : JsonResponse {
        $errors = [];
        foreach ($constraintViolationList as $index => $constraintViolation) {
            $errors[$index][$constraintViolation->getPropertyPath()] =
                $constraintViolation->getMessage();
        }
        $errors;
        return new JsonResponse($errors, JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
    }
}
