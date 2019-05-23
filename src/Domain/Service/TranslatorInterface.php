<?php
namespace App\Domain\Service;

interface TranslatorInterface
{
    public function translate(string $text) : string;
}
