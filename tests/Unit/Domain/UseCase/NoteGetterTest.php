<?php

namespace App\Tests\Unit\Domain\UseCase;

use PHPUnit\Framework\TestCase;

class NoteGetterTest extends TestCase
{
    private const NOTE_ID = 1; 
    
    public function testExecute() : void
    {
        $noteGetter = new NoteGetter();
        $response = $noteGetter->execute(self::NOTE_ID);

    }
}
