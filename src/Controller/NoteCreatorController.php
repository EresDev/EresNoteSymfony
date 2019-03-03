<?php

namespace EresNote\Controller;

use EresNote\Domain\Service\Factory\NoteFactory;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class NoteCreatorController extends CreatorTemplate
{
    protected function getFactory() : string
    {
        return NoteFactory::class;
    }

    protected function getSuccessResponse(): Response
    {
        return new Response($this->translator->trans("creator.note.success"));
    }

    protected function getFailureResponse(
        ConstraintViolationListInterface $constraintViolationList
    ) : Response {
        return new Response("Failure", Response::HTTP_BAD_REQUEST);
    }
}
