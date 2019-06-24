<?php

namespace App\Domain\Entity;

class Note extends Entity
{
    private $title;
    private $content;
    private $creationDatetime;
    private $user;

    public function __construct(
        string $title,
        string $content,
        \DateTime $creationDatetime,
        User $user,
        int $id = null
    ){
        $this->setId($id);
        $this->setTitle($title);
        $this->setContent($content);
        $this->setCreationDatetime($creationDatetime);
        $this->setUser($user);
    }

    public function getTitle() : string
    {
        return $this->title;
    }

    public function setTitle($title): void
    {
        $this->title = $title;
    }

    public function getContent() : string
    {
        return $this->content;
    }

    public function setContent($content): void
    {
        $this->content = $content;
    }

    public function getCreationDatetime() : \DateTime
    {
        return $this->creationDatetime;
    }


    public function setCreationDatetime(\DateTime $creationDatetime): void
    {
        $this->creationDatetime = $creationDatetime;
    }

    public function getUser() : User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

}
