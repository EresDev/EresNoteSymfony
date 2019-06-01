<?php

namespace App\Controller;

use App\Domain\Service\Http\Request;
use App\Domain\Service\ValueObject\HttpResponse;
use App\UseCase\UseCase;

class NoteCreatorController extends Controller
{
    /**
     * @var UseCase
     */
    private $useCase;
    /**
     * @var Request
     */
    private $request;

    public function __construct(
        useCase $useCase,
        Request $request
    ) {
        $this->request = $request;
        $this->useCase = $useCase;
    }

    protected function getResponse(): HttpResponse
    {
        $requestParameters = $this->request->getAllPostData();
        $response = $this->useCase->execute($requestParameters);

        return $response;
    }
}
