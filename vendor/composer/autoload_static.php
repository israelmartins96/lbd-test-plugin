<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf9ffc9f4f105757bd20659f2b1310c94
{
    public static $prefixLengthsPsr4 = array (
        'I' => 
        array (
            'Includes\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Includes\\' => 
        array (
            0 => __DIR__ . '/../..' . '/includes',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf9ffc9f4f105757bd20659f2b1310c94::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf9ffc9f4f105757bd20659f2b1310c94::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitf9ffc9f4f105757bd20659f2b1310c94::$classMap;

        }, null, ClassLoader::class);
    }
}
