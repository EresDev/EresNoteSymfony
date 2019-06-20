<?php

namespace App\Tests\Integration\ThirdParty\Adapter\Symfony;

use App\Tests\Extra\FixtureWebTestCase;
use App\ThirdParty\Adapter\Symfony\TranslatorAdapter;
use Symfony\Component\Translation\Loader\XliffFileLoader;
use Symfony\Component\Translation\Translator;

class TranslatorAdapterTest extends FixtureWebTestCase
{
    /**
     * @var Translator
     */
    private $translator;

    protected function setUp()
    {
        parent::setUp();
        $this->translator = new Translator('en');

        $this->translator->addLoader('xlf', new XliffFileLoader());

        $this->translator->addResource(
            'xlf',
            self::$container->getParameter('kernel.project_dir').'/tests/Extra/translations/messages.en.xlf',
            'en'
        );

        $this->translator->addResource(
            'xlf',
            self::$container->getParameter('kernel.project_dir').'/tests/Extra/translations/messages.de.xlf',
            'de_DE'
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
