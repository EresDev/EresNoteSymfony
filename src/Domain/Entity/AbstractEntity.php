<?php

namespace EresNote\Domain\Entity;

abstract class AbstractEntity
{
    protected $id;

    public function getId() : int
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }


}
