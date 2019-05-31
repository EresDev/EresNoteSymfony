<?php

namespace App\Controller;

use App\Domain\Service\Http\Request;
use App\Domain\Service\Http\Response;
use App\UseCase\UseCase;

class NoteCreatorController extends ControllerTemplate
{
    /**
     * @var useCase
     */
    private $useCase;
    /**
     * @var Request
     */
    private $request;

    public function __construct(
        UseCase $useCase,
        Request $request
    ) {

        $this->request = $request;
        $this->useCase = $useCase;
    }

    protected function getResponse() : Response
    {
        $requestParameters = $this->request->getAllPostData();
        $response = $this->useCase->execute($requestParameters);

        return $response;
    }
}
