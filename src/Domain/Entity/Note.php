<?php

namespace EresNote\Domain\Entity;

class Note extends AbstractEntity implements \JsonSerializable
{
    private $title;
    private $content;
    private $creationDatetime;
    private $user;

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

    public function getUser()
    {
        //TODO set return type when security user has been created
        return $this->user;
    }

    public function setUser($user): void
    {
        $this->user = $user;
    }

    public function jsonSerialize()
    {
        $vars = get_object_vars($this);

        return $vars;
    }
}
