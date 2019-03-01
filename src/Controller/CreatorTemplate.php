<?php

namespace EresNote\Controller;

use EresNote\Domain\Entity\AbstractEntity;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;


abstract class CreatorTemplate
{
    public function create(Request $request, ValidatorInterface $validator)
    {
        $factory = $this->getFactory();
        $entity = $factory->createFromParameters($request->get()->all());

        $errors = $validator->validate($entity);
        if ($errors->count() === 0) {
            $this->processPreSuccessHook();
            return $this->getSuccessResponse();
        }

        return $this->getFailureResponse();
    }

    abstract protected function getFactory();

    protected function processPreSuccessHook()
    {

    }

    abstract protected function getSuccessResponse();

    abstract protected function getFailureResponse();
}
