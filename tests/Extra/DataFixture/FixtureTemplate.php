<?php

namespace App\Tests\Extra\DataFixture;

use App\Domain\Entity\AbstractEntity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

abstract class FixtureTemplate extends Fixture
{
    public function load(ObjectManager $manager) : void
    {
        $entity = $this->getEntity();
        $manager->persist($entity);

        $manager->flush();
    }

    abstract public function getEntity() : AbstractEntity;
}
