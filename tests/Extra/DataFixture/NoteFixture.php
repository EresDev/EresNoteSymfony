<?php

namespace App\Tests\Extra\DataFixture;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Domain\Entity\Note;

class NoteFixture extends Fixture
{
    public function load(ObjectManager $manager) : void
    {
        $note = new Note();
        $note->setTitle('A test title');
        $note->setContent('Some test content');
        $note->setCreationDatetime(new \DateTime());

        $user = $this->getReference(UserFixture::USER_REFERENCE);

        $note->setUser($user->getId());

        $manager->persist($note);
        $manager->flush();
    }


}
