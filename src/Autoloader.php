<?php

declare(strict_types=1);

/**
 * Class Autoloader
 *
 * Autoloader handler class is responsible for loading the different
 * classes needed to run the app.
 */
class Autoloader
{

    /**
     * Default path for autoloader.
     *
     * @var string
     */
    private static string $defaultPath;

    /**
     * Default class map for autoloader.
     * Use this if you prefer/need to map your classes manually
     *
     * @var array
     */
    private static array $classMap = [];

    /**
     * Autoload.
     *
     * For a given class, check if it exists and load it.
     *
     * @param string $fullyQualifiedName
     *
     * @since 1.0.0
     * @access private
     * @static
     */
    private static function autoload(string $fullyQualifiedName): void
    {
        $ds = DIRECTORY_SEPARATOR;
        $qualifiedPath = str_replace('\\', $ds, $fullyQualifiedName);
        $fullyQualifiedPath = self::$defaultPath . $ds . $qualifiedPath . '.php';

        if (!file_exists($fullyQualifiedPath)) {
            // TODO: throw an error here
            return;
        }

        if (!class_exists($fullyQualifiedName) && is_readable($fullyQualifiedPath)) {
            require $fullyQualifiedPath;
        }
    }

    /**
     * Run autoloader.
     *
     * Register a function as `__autoload()` implementation.
     *
     * @since 1.0.0
     * @access public
     * @static
     */
    public static function run(): void
    {
        self::$defaultPath = __DIR__;
        spl_autoload_register([__CLASS__, 'autoload']);
    }
}
