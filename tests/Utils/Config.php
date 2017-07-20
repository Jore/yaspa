<?php

namespace Yaspa\Tests\Utils;

use stdClass;

class Config
{
    const PATH_TO_CONFIG = __DIR__.'/../../test-config.json';
    const DEFAULT_ATTRIBUTE_SEPARATOR = '.';

    /** @var stdClass $configData */
    protected $configData;

    /**
     * Config constructor.
     * @param string $pathToConfig Should be path to JSON file tht follows `test-config.example.json`
     */
    public function __construct(string $pathToConfig = self::PATH_TO_CONFIG)
    {
        $this->configData = json_decode(file_get_contents($pathToConfig));
    }

    /**
     * Using dot-notation, or other method, get a test config attribute.
     *
     * @param string $attribute
     * @param string $separator
     * @return mixed
     */
    public function get(
        string $attribute,
        string $separator = self::DEFAULT_ATTRIBUTE_SEPARATOR
    ) {
        // Get the next property
        $attributeParts = explode($separator, $attribute);
        $nextAttribute = array_shift($attributeParts);
        $remainingAttribute = implode($separator, $attributeParts);

        // If not found, return null
        if (!property_exists($this->configData, $nextAttribute)) {
            return null;
        }

        // If found and no remaining parts to attribute, return value
        if (empty($attributeParts)) {
            return $this->configData->{$nextAttribute};
        }

        // Continue traversing object
        return $this->get($remainingAttribute, $separator);
    }
}
