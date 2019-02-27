<?php


namespace EresNote\Domain\Service\Http;


interface RequestAdapter
{
    public function getParameter(string $key, $defaultValue);
}
