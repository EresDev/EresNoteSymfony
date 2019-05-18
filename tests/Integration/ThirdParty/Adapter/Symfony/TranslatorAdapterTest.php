<?php
namespace EresNote\Tests\Integration\ThirdParty\Adapter\Symfony;

use EresNote\ThirdParty\Adapter\Symfony\TranslatorAdapter;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TranslatorAdapterTest extends KernelTestCase
{
    private $symfonyTranslator;

    protected function setUp()
    {
        self::bootKernel();

        $this->symfonyTranslator = self::$container->get(
            'Symfony\Contracts\Translation\TranslatorInterface'
        );
    }

    public function testTranslateForDefaultLocaleEnglish()
    {
        $translatorAdapter = new TranslatorAdapter($this->symfonyTranslator);

        $testString = 'tests.integration.translation.adapter';

        $translatedString = $translatorAdapter->translate($testString);

        $expected = 'A test translation string.';

        $this->assertEquals($expected, $translatedString);
    }

    public function testTranslateForModifiedLocaleGerman()
    {
        $this->symfonyTranslator->setLocale('de_DE');

        $translatorAdapter = new TranslatorAdapter($this->symfonyTranslator);

        $testString = 'tests.integration.translation.adapter';

        $translatedString = $translatorAdapter->translate($testString);

        $expected = 'Ein Testübersetzungsstring.';

        $this->assertEquals($expected, $translatedString);
    }
}
