<?php


namespace App\Domain\Service\Factory;


use App\Domain\Entity\AbstractEntity;

interface EntityFactoryInterface
{
    public function createFromParameters(array $parameters) : AbstractEntity;
}
