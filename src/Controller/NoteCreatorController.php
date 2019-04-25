<?php

namespace EresNote\Controller;

use EresNote\Domain\Service\TranslatorInterface;
use EresNote\UseCase\CreateNoteUseCase;
use Symfony\Component\HttpFoundation\RequestStack;

class NoteCreatorController extends ControllerTemplate
{
    private $createNoteUseCase;

    public function __construct(
        TranslatorInterface $translator,
        RequestStack $requestStack,
        CreateNoteUseCase $createNoteUseCase
    ) {
        parent::__construct($translator, $requestStack);
        $this->createNoteUseCase = $createNoteUseCase;
    }

    protected function prepareResponse(): void
    {
        $requestParameters = $this->request->request->all();
        $simpleResponse = $this->createNoteUseCase->execute($requestParameters);

        $this->response->setStatusCode($simpleResponse->getStatusCode());
        $this->response->setContent($simpleResponse->getContent());
    }
}
