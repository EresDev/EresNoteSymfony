<?php

namespace App\Controller;

use App\Domain\Service\Http\RequestAdapterInterface;
use App\Domain\Service\TranslatorInterface;
use App\UseCase\CreateNoteUseCase;

class NoteCreatorController extends ControllerTemplate
{
    /**
     * @var CreateNoteUseCase
     */
    private $createNoteUseCase;
    /**
     * @var RequestAdapterInterface
     */
    private $requestAdapter;

    public function __construct(
        TranslatorInterface $translator,
        CreateNoteUseCase $createNoteUseCase,
        RequestAdapterInterface $requestAdapter
    ) {
        parent::__construct($translator);

        $this->requestAdapter = $requestAdapter;
        $this->createNoteUseCase = $createNoteUseCase;
    }

    protected function prepareResponse(): void
    {
        $requestParameters = $this->requestAdapter->getAllPostData();
        $simpleResponse = $this->createNoteUseCase->execute($requestParameters);

        $this->response->setStatusCode($simpleResponse->getStatusCode());
        $this->response->setContent($simpleResponse->getContent());
    }
}
