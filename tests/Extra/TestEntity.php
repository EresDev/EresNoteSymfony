<?php
namespace EresNote\Tests\Extra;

use EresNote\Domain\Entity\AbstractEntity;

class TestEntity extends AbstractEntity
{
    private $title;

    public function __construct(string $title)
    {
        $this->title = $title;
    }

    public function getTitle() : string
    {
        return $this->title;
    }

    public function setTitle($title): void
    {
        $this->title = $title;
    }

}
