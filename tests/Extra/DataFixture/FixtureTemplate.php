<?php

namespace App\Tests\Extra\DataFixture;

use App\Domain\Entity\AbstractEntity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\ProxyReferenceRepository;
use Doctrine\Common\DataFixtures\ReferenceRepository;
use Doctrine\Common\Persistence\ObjectManager;

abstract class FixtureTemplate extends Fixture
{


    public function load(ObjectManager $manager) : void
    {
//        $this->setReferenceRepository(new ReferenceRepository($manager));
//
//        $entity = $this->getEntity();
//        $manager->persist($entity);
//        $manager->flush();
//
//        $this->addReference(get_class($this), $entity);
    }

    abstract public function getEntity() : AbstractEntity;
}
