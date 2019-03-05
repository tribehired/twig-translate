<?php

namespace TribeHired\TwigLocale;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Class Translate
 * @package TribeHired\TwigLocale
 */
class Translate extends AbstractExtension
{
    private $filepath;
    private $locale;

    /**
     * Translate constructor.
     * @param $path
     * @param string $locale
     */
    public function __construct($path, $locale = 'en')
    {
        $this->filepath = $path;
        $this->locale = $locale;
    }

    /**
     * @return array|\Twig_Function[]
     */
    public function getFunctions()
    {
        return [
            new TwigFunction('trans', [$this, 'translate']),
        ];
    }

    /**
     * @param string $key
     * @param array $data
     * @return string
     */
    public function translate(string $key, array $data = [])
    {
        $dictionaryFile = include $this->filepath;
        $dictionaryData = $dictionaryFile[$this->locale];

        if (!array_key_exists($key, $dictionaryData)) {
            return $key;
        }

        if (!count($data)) {
            return $dictionaryData[$key];
        }

        return strtr($dictionaryData[$key], $data);
    }
}
