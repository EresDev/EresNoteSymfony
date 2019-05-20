<?php
namespace EresNote\Tests\Integration\ThirdParty\Adapter\Symfony;

use EresNote\ThirdParty\Adapter\Symfony\TranslatorAdapter;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TranslatorAdapterTest extends KernelTestCase
{
    private $translator;

    protected function setUp()
    {
        self::bootKernel();

        $this->translator = self::$container->get(
            'Symfony\Contracts\Translation\TranslatorInterface'
        );
    }

    public function testTranslateForDefaultLocaleEnglish()
    {
        $translatorAdapter = new TranslatorAdapter($this->translator);

        $testString = 'tests.integration.translation.adapter';

        $translatedString = $translatorAdapter->translate($testString);

        $expected = 'A test translation string.';

        $this->assertEquals($expected, $translatedString);
    }

    public function testTranslateForModifiedLocaleGerman()
    {
        $this->translator->setLocale('de_DE');

        $translatorAdapter = new TranslatorAdapter($this->translator);

        $testString = 'tests.integration.translation.adapter';

        $translatedString = $translatorAdapter->translate($testString);

        $expected = 'Ein Testübersetzungsstring.';

        $this->assertEquals($expected, $translatedString);
    }
}
