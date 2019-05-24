<?php

namespace App\Domain\Entity;


class User extends AbstractEntity
{
    private $email;
    private $password;
    private $activated;
    private $deleted;
    private $memberSince;

    public function getEmail() : string
    {
        return $this->email;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function getPassword() : string
    {
        return $this->password;
    }


    public function setPassword($password): void
    {
        $this->password = $password;
    }

    public function getActivated() : bool
    {
        return $this->active;
    }

    public function setActivated($active): void
    {
        $this->active = $active;
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
