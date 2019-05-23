<?php
namespace App\ThirdParty\Adapter\Symfony;

use App\Domain\Service\TranslatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface as SymfonyTranslator;

class TranslatorAdapter implements TranslatorInterface
{
    private $translator;

    public function __construct(SymfonyTranslator $translator)
    {
        $this->translator = $translator;
    }

    public function translate(string $text): string
    {
        return $this->translator->trans($text);
    }
}
