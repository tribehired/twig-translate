<?php

namespace TribeHired\TwigTranslate\Test;

use PHPUnit\Framework\TestCase;
use TribeHired\TwigTranslate\Translate;

/**
 * Class MainTest
 * @package TribeHired\TwigTranslate\Test
 */
class MainTest extends TestCase
{
    /** @var string $path */
    private $path = __DIR__ . '/dictionary/en.php';

    /**
     * @throws \Exception
     */
    public function testTextSimple()
    {
        $translator = new Translate($this->path);
        $expected = 'Hello world!';
        $text = $translator->translate('textSimple');
        $this->assertEquals($expected, $text);
    }

    /**
     * @throws \Exception
     */
    public function testTextWithData()
    {
        $translator = new Translate($this->path);
        $value = 'apple';
        $expected = 'The data value is: ' . $value . '.';
        $text = $translator->translate('textWithData', ['data' => $value]);
        $this->assertEquals($expected, $text);
    }
}
