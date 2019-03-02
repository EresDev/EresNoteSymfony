<?php

namespace EresNote\Domain\Entity;

class Note extends AbstractEntity
{
    public $title;
    public $content;
    public $creationDatetime;
    public $user;
}
