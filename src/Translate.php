<?php

namespace TribeHired\TwigTranslate;

use Twig\Error\Error;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Class Translate
 * @package TribeHired\TwigTranslate
 */
class Translate extends AbstractExtension
{
    /** @var array $dictionary */
    private $dictionary;

    /**
     * Translate constructor.
     * @param string $dictionaryPath
     * @throws Error
     */
    public function __construct(string $dictionaryPath)
    {
        try {
            $this->dictionary = include $dictionaryPath;
        } catch (\Exception $e) {
            throw new Error('Unable to include dictionary path "' . $dictionaryPath . '"');
        }
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
     */
    public function translate(string $term, array $data = []): string
    {
        if (!array_key_exists($term, $this->dictionary)) {
            return $term;
        }

        if (!count($data)) {
            return $this->dictionary[$term];
        }

        $dataItems = [];
        foreach ($data as $key => $value) {
            $dataItems[':' . $key] = $value;
        }

        return strtr($this->dictionary[$term], $dataItems);
    }
}
