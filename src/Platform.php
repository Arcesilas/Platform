<?php

namespace Arcesilas\Platform;

/**
 * Some functions are partially or entirely borrowed from Composer\Factory and/or Composer\Util\Platform
 */
final class Platform
{
    /**
     * @var string
     */
    private static $home;

    /**
     * Returns whether the OS is Windows or not
     * @return bool
     */
    public static function isWindows()
    {
        return defined('PHP_WINDOWS_VERSION_BUILD');
    }

    /**
     * Returns the user's home directory
     * @return string
     */
    public static function getUserHome()
    {
        if (null === self::$home) {
            self::$home = self::findUserHome();
        }

        return self::$home;
    }

    /**
     * Finds the user's home directory
     * @return string
     */
    private static function findUserHome()
    {
        if (false !== ($home = getenv('HOME'))) {
            return $home;
        }

        if (self::isWindows() && false !== ($home = getenv('USERPROFILE'))) {
            return $home;
        }

        if (function_exists('posix_getuid') && function_exists('posix_getpwuid')) {
            $info = posix_getpwuid(posix_getuid());

            return $info['dir'];
        }

        throw new \RuntimeException('Could not determine user directory');
    }

    /**
     * Returns an appropriate data directory
     * @return string
     */
    public static function getDataDir()
    {
        return self::getDir('getDataHome');
    }

    /**
     * Returns an appropriate config directory
     * @return string
     */
    public static function getConfigDir()
    {
        return self::getDir('getConfigHome');
    }

    /**
     * Returns an appropriate config directory
     * @return string
     */
    public static function getCacheDir()
    {
        return self::getDir('getCacheHome');
    }

    /**
     * Returns an appropriate directory
     * @param  string $xdgFunc Method on Xdg class to use to get the appropriate directory
     * @return string
     */
    private static function getDir($xdgFunc)
    {
        $home = self::getUserHome();

        if (self::isWindows()) {
            return self::findWindowsDataDir() ?: $home;
        }

        if (Xdg::isUsed()) {
            return call_user_func([Xdg::class, $xdgFunc], $home);
        }

        return $home;
    }

    /**
     * Finds the config directory
     * @return string
     */
    private static function findWindowsDataDir()
    {
        return getenv('LOCALAPPDATA') ?: getenv('APPDATA');
    }
}
