<?php

namespace App\ThirdParty\Adapter\Symfony;

use App\Domain\Service\Http\Request\GetParameterGetter;
use App\Domain\Service\Http\Request\PostParametersGetter;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;
use Symfony\Component\HttpFoundation\RequestStack;

class RequestAdapter implements PostParametersGetter, GetParameterGetter
{
    /**
     * @var SymfonyRequest
     */
    private $request;

    public function __construct(RequestStack $requestStack)
    {
        $this->request = $requestStack->getCurrentRequest();
    }

    public function getAll(): array
    {
        return $this->request->request->all();
    }

    public function get(string $key, string $defaultValue = null): string
    {
        return $this->request->get($key, $defaultValue);
    }


}
