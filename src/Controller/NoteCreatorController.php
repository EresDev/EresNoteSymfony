<?php

namespace App\Controller;

use App\Domain\Service\Http\Request;
use App\Domain\Service\ValueObject\HttpResponse;
use App\UseCase\CreateNoteUseCase;

class NoteCreatorController extends Controller
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
        $this->requestAdapter = $requestAdapter;
        $this->createNoteUseCase = $createNoteUseCase;
    }

    protected function getResponse(): HttpResponse
    {
        $requestParameters = $this->requestAdapter->getAllPostData();
        $response = $this->createNoteUseCase->execute($requestParameters);

        return $response;
    }
}
