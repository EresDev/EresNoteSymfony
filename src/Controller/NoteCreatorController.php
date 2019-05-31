<?php

namespace App\Controller;

use App\Domain\Service\Http\RequestAdapterInterface;
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
        CreateNoteUseCase $createNoteUseCase,
        RequestAdapterInterface $requestAdapter
    ) {
        parent::__construct();

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
