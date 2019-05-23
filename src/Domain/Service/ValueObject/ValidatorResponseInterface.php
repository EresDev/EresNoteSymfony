<?php


namespace App\Domain\Service\ValueObject;


interface ValidatorResponseInterface
{
    public function isValid() : bool;
    public function getErrors() : array;
}
