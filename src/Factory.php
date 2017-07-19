<?php

namespace Yaspa;

use GuzzleHttp;
use UnexpectedValueException;
use Yaspa\OAuth;
use Yaspa\Transformers;

/**
 * Class Factory
 * @package Yaspa
 *
 * Factory class for all Yaspa service classes.
 *
 * Model instances are expected to be created using 'new' as they should have no dependencies.
 */
class Factory
{
    /** @var callable[] $constructors */
    protected static $constructors;

    /**
     * Make a instance of a service class.
     *
     * @param string $className
     * @return mixed
     * @throws UnexpectedValueException When a service class constructor hasn't been defined
     */
    public static function make(string $className)
    {
        // Constructors is a singleton array
        if (is_null(self::$constructors)) {
            self::$constructors = self::makeConstructors();
        }

        // If we don't know how to create a given class, throw exception
        if (!isset(self::$constructors[$className])) {
            $message = sprintf('Cannot make a new instance of class: %s', $className);
            throw new UnexpectedValueException($message);
        }

        // Otherwise, create an instance of the requested class
        return call_user_func(self::$constructors[$className]);
    }

    /**
     * Create constructors.
     *
     * This is effectively the master service definition list.
     *
     * Remember to annotate in `.phpstorm.meta.php/Factory.meta.php` as well.
     *
     * @return callable[]
     */
    protected static function makeConstructors(): array
    {
        return [
            GuzzleHttp\Client::class => function () {
                return new GuzzleHttp\Client();
            },
            OAuth\ConfirmInstallation::class => function () {
                return new OAuth\ConfirmInstallation(
                    self::make(GuzzleHttp\Client::class),
                    self::make(OAuth\SecurityChecks::class),
                    self::make(Transformers\Authentication\OAuth\ConfirmationRedirect::class)
                );
            },
            OAuth\SecurityChecks::class => function () {
                return new OAuth\SecurityChecks();
            },
            Transformers\Authentication\OAuth\ConfirmationRedirect::class => function () {
                return new Transformers\Authentication\OAuth\ConfirmationRedirect();
            },
        ];
    }
}