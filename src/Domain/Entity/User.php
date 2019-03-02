<?php


namespace EresNote\Domain\Entity;


class User extends AbstractEntity
{
    public $email;
    public $password;
    public $active;
    public $deleted;
    public $memberSince;
}
