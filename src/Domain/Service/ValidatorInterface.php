<?php


namespace App\Domain\Service;


use App\Domain\Entity\AbstractEntity;
use App\Domain\Service\ValueObject\ValidatorResponseInterface;

interface ValidatorInterface
{
    public function validate(AbstractEntity $entity) : ValidatorResponseInterface;
}
