<?php

namespace AylesSoftware\XeroLaravel;

use Exception;

class Utils
{
    public static $vendor;

    /**
     * Finds and returns the project's root directory
     * (containing the composer.json file).
     *
     * @return null|string
     * @throws Exception
     */
    public static function getProjectRootDirectory()
    {
        $root = null;
        $directory = dirname(__FILE__);

        do {
            $directory = dirname($directory);
            $composer = static::normalizePath("{$directory}/composer.json");
            $vendor = static::normalizePath("{$directory}/vendor/");

            if (file_exists($composer) && is_dir($vendor)) {
                $root = $directory;
            }
        } while (is_null($root) && $directory != DIRECTORY_SEPARATOR);

        if (! is_null($root)) {
            return $root;
        }

        throw new Exception('Unable to determine project root directory.');
    }

    /**
     * @return string
     * @throws Exception
     */
    public static function getVendorDirectory()
    {
        if (static::$vendor) {
            return static::$vendor;
        }

        return static::$vendor = static::normalizePath(
            static::getProjectRootDirectory().'/vendor'
        );
    }

    public static function normalizePath($path)
    {
        return str_replace('/', DIRECTORY_SEPARATOR, $path);
    }
}
