<?php
namespace App\Controller;

use App\Domain\Service\TranslatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;

abstract class ControllerTemplate
{
    protected $translator;
    protected $response;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
        $this->response = new JsonResponse();
    }

    public function handleRequest() : JsonResponse {
        $this->prepareResponse();
        return $this->response;
    }

    protected abstract function prepareResponse() : void;
}
