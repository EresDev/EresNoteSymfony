<?php


namespace EresNote\Domain\Service;


interface TranslatorInterface
{
    public function translate(string $text) : string;
}
