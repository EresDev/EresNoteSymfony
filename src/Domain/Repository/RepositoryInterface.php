<?php


namespace EresNote\Domain\Repository;


use EresNote\Domain\Entity\AbstractEntity;

interface RepositoryInterface
{
    public function persist(AbstractEntity $entity);
}
