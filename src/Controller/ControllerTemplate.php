<?php


namespace EresNote\Controller;

use EresNote\Domain\Service\TranslatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;

abstract class ControllerTemplate
{
    protected $translator;
    protected $request;
    protected $response;

    public function __construct(TranslatorInterface $translator, RequestStack $requestStack)
    {
        $this->translator = $translator;
        $this->request = $requestStack->getCurrentRequest();
        $this->response = new JsonResponse();
    }

    public function handleRequest() : JsonResponse {
        $this->prepareResponse();
        return $this->response;
    }

    protected abstract function prepareResponse() : void;
}
