<?php

namespace EresNote\Tests\Extra\DataFixture;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use EresNote\Domain\Entity\Note;

class NoteFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $note = new Note();
        $note->setId(1111);
        $note->setTitle('1A test title');
        $note->setContent('Some test content');
        $note->setCreationDatetime(new \DateTime());
        $note->setUser(1);

        $manager->persist($note);
        $manager->flush();
    }
}
