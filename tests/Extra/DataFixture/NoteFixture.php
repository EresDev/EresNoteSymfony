<?php

namespace App\Tests\Extra\DataFixture;

use App\Domain\Entity\AbstractEntity;
use App\Domain\Entity\Note;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class NoteFixture extends FixtureTemplate implements DependentFixtureInterface
{
    public function load(ObjectManager $manager) : void
    {
        parent::load($manager);
    }

    public function getEntity() : AbstractEntity
    {
        $note = new Note();
        $note->setTitle('A test title');
        $note->setContent('Some test content');
        $note->setCreationDatetime(new \DateTime());

        $user = $this->getReference(UserFixture::class);
        $note->setUser($user);

        return $note;
    }

    public function getDependencies()
    {
        return array(
            UserFixture::class
        );
    }

}
