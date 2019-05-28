<?php

namespace App\ThirdParty\Persistence\Doctrine\Repository;

use Doctrine\ORM\EntityManagerInterface;
use App\Domain\Entity\AbstractEntity;
use App\Domain\Repository\RepositoryInterface;
use Doctrine\ORM\EntityRepository;

abstract class AbstractRepository extends EntityRepository implements RepositoryInterface
{
    protected $entityManager;
    protected $entityClass;

    public function __construct(EntityManagerInterface $entityManager)
    {
        if (empty($this->entityClass)) {
            throw new \RuntimeException(
                get_class($this) . '::$entityClass is not defined'
            );
        }

        parent::__construct(
            $entityManager,
            $entityManager->getClassMetadata($this->entityClass)
        );

        $this->entityManager = $entityManager;
    }

    public function getById($id)
    {
        return $this->entityManager->find($this->entityClass, $id);
    }

    public function getAll()
    {
        return $this->entityManager
            ->getRepository($this->entityClass)
            ->findAll();
    }

    public function getBy(
        $conditions = [],
        $order = [],
        $limit = null,
        $offset = null
    ) {
        $repository = $this->entityManager->getRepository(
            $this->entityClass
        );
        $results = $repository->findBy(
            $conditions,
            $order,
            $limit,
            $offset
        );
        return $results;
    }

    public function persist(AbstractEntity $entity)
    {
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

}
