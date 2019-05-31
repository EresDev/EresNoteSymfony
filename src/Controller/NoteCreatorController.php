<?php

namespace App\Controller;

use App\Domain\Service\Http\Request;
use App\UseCase\CreateNoteUseCase;

class NoteCreatorController extends ControllerTemplate
{
    /**
     * @var CreateNoteUseCase
     */
    private $createNoteUseCase;
    /**
     * @var Request
     */
    private $requestAdapter;

    public function __construct(
        CreateNoteUseCase $createNoteUseCase,
        Request $requestAdapter
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
