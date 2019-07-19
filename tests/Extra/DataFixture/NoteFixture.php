<?php

namespace App\Tests\Extra\DataFixture;

use App\Domain\Entity\Note;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class NoteFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        foreach ($this->getNotes() as $i => $note) {
            $manager->persist($note);

            $this->setReference(self::class . "_$i", $note);
        }
        $manager->flush();
    }

    public function getNotes()
    {
        $user = $this->getReference(AuthUserFixture::class);
        for ($i = 0; $i < 5; $i++) {
            yield new Note(
                "Some title $i",
                "Some test content $i",
                new \DateTime(),
                $user
            );
        }
    }
    public function getDependencies()
    {
        return array(
            AuthUserFixture::class
        );
    }
}
