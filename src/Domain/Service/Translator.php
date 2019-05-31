<?php
namespace App\Domain\Service;

interface Translator
{
    public function translate(string $text) : string;
}
