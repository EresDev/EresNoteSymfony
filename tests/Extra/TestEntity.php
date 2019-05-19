<?php
namespace EresNote\Tests\Extra;

class TestEntity
{
    private $title;

    public function getTitle() : string
    {
        return $this->title;
    }

    public function setTitle($title): void
    {
        $this->title = $title;
    }

}
