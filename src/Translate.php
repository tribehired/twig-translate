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
    /** @var array $dictionary */
    private $dictionary;

    /**
     * Translate constructor.
     * @param string $path
     * @param string $locale
     */
    public function __construct(string $path, string $locale = 'en')
    {
        $dictionaryFile = include $path;
        $this->dictionary = $dictionaryFile[$locale];
    }

    /**
     * @return array
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('trans', [$this, 'translate']),
        ];
    }

    /**
     * @param string $key
     * @param array $data
     * @return string
     * @throws \Exception
     */
    public function translate(string $key, array $data = []): string
    {
        if (!array_key_exists($key, $this->dictionary)) {
            throw new \Exception("Key does not exist in dictionary");
        }

        if (!count($data)) {
            return $this->dictionary[$key];
        }

        return strtr($this->dictionary[$key], $data);
    }
}
