<?php
namespace App\Domain\Service\Factory;

use App\Domain\Entity\AbstractEntity;
use App\Domain\Entity\Note;

final class NoteFactory implements EntityFactoryInterface
{
    public function createFromParameters(array $parameters) : AbstractEntity
    {
        $note = new Note();

        $note->setTitle($parameters['title'] ?? '');
        $note->setContent($parameters['content'] ?? '');
        $note->setCreationDatetime(new \DateTime());
        $note->setUser($parameters['user'] ?? null );

        return $note;
    }
}
