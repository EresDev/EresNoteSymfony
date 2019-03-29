<?php


namespace EresNote\Domain\Service\Factory;

use EresNote\Domain\Entity\AbstractEntity;
use EresNote\Domain\Entity\Note;

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
