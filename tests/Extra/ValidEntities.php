<?php

namespace App\Tests\Extra;

use App\Domain\Entity\Note;
use App\Domain\Entity\User;

class ValidEntities
{
    public static function getNote() : Note
    {
        $user = self::getUser();

        $note =  new Note(
          'A sample title',
          'Sample content.',
            new \DateTime(),
            $user
        );

        $note->setId(1);

        return $note;
    }

    public static function getUser() : User
    {
        $user = new User(
            'test@eresdev.com',
            'someRandomPassword@!1',
            true,
            false,
            new \DateTime()

        );

        $user->setId(1);

        return $user;
    }

    public static function getAnotherUser() : User
    {
        $user = new User(
            'test2@eresdev.com',
            'someRandomPassword@!2',
            true,
            false,
            new \DateTime()

        );

        $user->setId(2);

        return $user;
    }

}
