<?php

namespace App\Domain\Entity;

use Symfony\Component\Security\Core\User\UserInterface;

class User extends Entity implements UserInterface
{
    private $email;
    private $password;
    private $plainPassword;
    private $activated;
    private $deleted;
    private $memberSince;

    public function __construct(
        string $email,
        string $plainPassword,
        bool $activated,
        bool $deleted,
        \DateTime $memberSince
    ){
        $this->setEmail($email);
        $this->setPlainPassword($plainPassword);
        $this->setPassword($plainPassword);
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

    public function getPassword() : ?string
    {
        return $this->password;
    }

    public function setPassword($password): void
    {
        $this->password = $password;
    }

    public function getPlainPassword() : ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($plainPassword): void
    {
        $this->plainPassword = $plainPassword;
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

    public function getUsername() : string
    {
        return $this->getEmail();
    }

    public function getRoles() : array
    {
        return ['ROLE_USER'];
    }

    public function getSalt() : ?string
    {
        return '';
    }

    public function eraseCredentials() : void
    {
    }
}
