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
    public function __construct(string $path, string $locale)
    {
        $this->dictionary = include $path.'/'.$locale.'.php';
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
     * @param string $term
     * @param array $data
     * @return string
     * @throws \Exception
     */
    public function translate(string $term, array $data = []): string
    {
        if (!array_key_exists($term, $this->dictionary)) {
            throw new \Exception("Term does not exist in dictionary");
        }

        if (!count($data)) {
            return $this->dictionary[$term];
        }

        $dataItems = [];
        foreach ($data as $key => $value) {
            $dataItems[':'.$key] = $value;
        }

        return strtr($this->dictionary[$term], $dataItems);
    }
}
