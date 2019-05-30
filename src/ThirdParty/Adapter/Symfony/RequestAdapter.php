<?php

namespace App\ThirdParty\Adapter\Symfony;

use App\Domain\Service\Http\RequestAdapterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class RequestAdapter implements RequestAdapterInterface
{
    /**
     * @var Request
     */
    private $request;

    public function __construct(RequestStack $requestStack)
    {
        $this->request = $requestStack->getCurrentRequest();
    }

    public function getAllPostData(): array
    {
        return $this->request->request->all();
    }
}
