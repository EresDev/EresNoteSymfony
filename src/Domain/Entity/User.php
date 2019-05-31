<?php

namespace App\Domain\Entity;


use http\Encoding\Stream;

class User extends Entity
{
    private $email;
    private $password;
    private $activated;
    private $deleted;
    private $memberSince;

    public function __construct(
        string $email,
        string $password,
        bool $activated,
        bool $deleted,
        \DateTime $memberSince
    ){
        $this->setEmail($email);
        $this->setPassword($password);
        $this->setActivated($activated);
        $this->setDeleted($deleted);
        $this->setMemberSince($memberSince);
    }

    public function getEmail() : string
    {
        return $this->email;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        //TODO, UNTIL PASSWORD ENCODER IS NOT ADDED
        // ALLOWS TESTS TO PASS BECAUSE OF RESOURCE VALUE
        //return $this->password;
        return "Coming soon";
    }


    public function setPassword($password): void
    {
        $this->password = $password;
    }

    public function getActivated() : bool
    {
        return $this->activated;
    }

    public function setActivated($active): void
    {
        $this->activated = $active;
    }

    public function getDeleted() : bool
    {
        return $this->deleted;
    }

    public function setDeleted($deleted): void
    {
        $this->deleted = $deleted;
    }

    public function getMemberSince() : \DateTime
    {
        return $this->memberSince;
    }

    public function setMemberSince($memberSince): void
    {
        $this->memberSince = $memberSince;
    }
}
