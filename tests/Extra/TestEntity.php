<?php
namespace App\Tests\Extra;

use App\Domain\Entity\AbstractEntity;

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
