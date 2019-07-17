<?php

namespace App\Tests\Extra\DataFixture;

use App\Domain\Entity\Note;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class AnotherNoteFixture extends NoteFixture
{
    public function getNotes()
    {
        for ($i = 0; $i < 5; $i++) {
            yield new Note(
                "Some title $i",
                "Some test content $i",
                new \DateTime(),
                $this->getReference(AnotherAuthUserFixture::class)
            );
        }
    }
    public function getDependencies()
    {
        return array(
            AnotherAuthUserFixture::class
        );
    }

}
