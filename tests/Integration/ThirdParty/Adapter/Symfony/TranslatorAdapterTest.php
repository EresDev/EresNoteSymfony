<?php

namespace App\Tests\Integration\ThirdParty\Adapter\Symfony;

use App\Tests\Extra\FixtureWebTestCase;
use App\ThirdParty\Adapter\Symfony\TranslatorAdapter;

class TranslatorAdapterTest extends FixtureWebTestCase
{
    private $translator;

    protected function setUp()
    {
        parent::setUp();
        $this->translator = parent::getService(
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
