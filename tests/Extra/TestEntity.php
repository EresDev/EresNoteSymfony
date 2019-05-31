<?php
namespace App\Tests\Extra;

use App\Domain\Entity\Entity;

class TestEntity extends Entity
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
