<?php


namespace EresNote\Domain\Service\Factory;


use EresNote\Domain\Entity\AbstractEntity;

interface EntityFactoryInterface
{
    public static function createFromParameters(array $parameters) : AbstractEntity;
}
