<?php

namespace App\Controller;

use App\Domain\Service\Http\Request\PutParametersGetter;
use App\Domain\Service\ValueObject\HttpResponse;
use App\Domain\UseCase\UseCase;

class UpdateNoteController extends Controller
{
    private $useCase;
    private $putParametersGetter;

    public function __construct(UseCase $useCase, PutParametersGetter $putParametersGetter)
    {
        $this->useCase = $useCase;
        $this->putParametersGetter = $putParametersGetter;
    }

    protected function getResponse(): HttpResponse
    {
        $noteUpdatedData = $this->putParametersGetter->getAll();

        return $this->useCase->execute($noteUpdatedData);
    }
}
