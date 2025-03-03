<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit81d3895fabc6ba2b623fb899ccb8430f
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Src\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Src\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit81d3895fabc6ba2b623fb899ccb8430f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit81d3895fabc6ba2b623fb899ccb8430f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit81d3895fabc6ba2b623fb899ccb8430f::$classMap;

        }, null, ClassLoader::class);
    }
}
