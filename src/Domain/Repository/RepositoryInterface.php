<?php


namespace EresNote\Domain\Repository;


use EresNote\Domain\Entity\AbstractEntity;

interface RepositoryInterface
{
    public function getById($id);
    public function getAll();
    public function persist(AbstractEntity $entity);
}
