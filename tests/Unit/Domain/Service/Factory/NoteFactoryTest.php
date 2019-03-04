<?php


namespace EresNote\Tests\Unit\Domain\Service\Factory;


use EresNote\Domain\Entity\Note;
use EresNote\Domain\Service\Factory\NoteFactory;
use PHPUnit\Framework\TestCase;

class NoteFactoryTest extends TestCase
{
    public function testCreateFromParameters_WithValidData() : void
    {
        $validParameters = $this->getValidParameters();

        $note = NoteFactory::createFromParameters($validParameters);

        $this->assertInstanceOf(
            Note::class,
            $note,
            'Object created by NoteFactory is not a Note instance.'
        );

        $this->assertEveryAttribute($validParameters, $note);
    }

    private function getValidParameters() : array
    {
        $validParameters = [
            'title' => 'A sample title',
            'content' => 'A sample content',
            'user' => 1
        ];

        return $validParameters;
    }

    private function assertEveryAttribute(array $expected, Note $note) : void
    {
        $this->assertEquals($expected['title'], $note->title);
        $this->assertEquals($expected['content'], $note->content);
        $this->assertEquals($expected['user'], $note->user);
    }
}
