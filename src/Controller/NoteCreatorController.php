<?php

namespace EresNote\Controller;

use EresNote\Domain\Entity\AbstractEntity;
use EresNote\Domain\Service\Factory\NoteFactory;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class NoteCreatorController extends CreatorTemplate
{
    protected function getFactory() : string
    {
        return NoteFactory::class;
    }

    protected function getSuccessResponse(AbstractEntity $entity): Response
    {
        return new Response($entity, Response::HTTP_OK);
    }

    protected function getFailureResponse(
        ConstraintViolationListInterface $constraintViolationList
    ) : Response {
        $errors = [];
        foreach ($constraintViolationList as $index => $constraintViolation) {
            $errors[$index][$constraintViolation->getPropertyPath()] =
                $constraintViolation->getMessage();
        }
        $errors;
        return new Response("", Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
