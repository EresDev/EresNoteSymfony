<?php


namespace EresNote\Domain\Service\Factory;


use EresNote\Domain\Entity\AbstractEntity;

interface EntityFactoryInterface
{
    public function createFromParameters(array $parameters) : AbstractEntity;
}
