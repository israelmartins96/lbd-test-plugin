<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitf9ffc9f4f105757bd20659f2b1310c94
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInitf9ffc9f4f105757bd20659f2b1310c94', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitf9ffc9f4f105757bd20659f2b1310c94', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitf9ffc9f4f105757bd20659f2b1310c94::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
