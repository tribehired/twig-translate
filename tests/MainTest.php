<?php

namespace TribeHired\TwigLocale\Test;

use PHPUnit\Framework\TestCase;
use TribeHired\TwigLocale\Translate;

/**
 * Class MainTest
 * @package TribeHired\TwigLocale\Test
 */
class MainTest extends TestCase
{
    /** @var string $path */
    private $path = __DIR__ . '/dictionary';

    /**
     * @throws \Exception
     */
    public function testTextSimple()
    {
        $translator = new Translate($this->path, 'en');
        $expected = 'Hello world!';
        $text = $translator->translate('textSimple');
        $this->assertEquals($expected, $text);
    }

    /**
     * @throws \Exception
     */
    public function testTextWithData()
    {
        $translator = new Translate($this->path, 'en');
        $value = 'apple';
        $expected= 'The data value is: '.$value.'.';
        $text = $translator->translate('textWithData', ['data' => $value]);
        $this->assertEquals($expected, $text);
    }
}
