<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit612e8382731b0caf052f0e75db9dc421
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Model\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Model\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Model',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit612e8382731b0caf052f0e75db9dc421::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit612e8382731b0caf052f0e75db9dc421::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit612e8382731b0caf052f0e75db9dc421::$classMap;

        }, null, ClassLoader::class);
    }
}
