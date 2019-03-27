<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitaa6ce6bb018d019815f4e70cf3983f43
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Config\\' => 7,
        ),
        'A' => 
        array (
            'Admin\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Config\\' => 
        array (
            0 => __DIR__ . '/../..' . '/config',
        ),
        'Admin\\' => 
        array (
            0 => __DIR__ . '/../..' . '/admin',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitaa6ce6bb018d019815f4e70cf3983f43::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitaa6ce6bb018d019815f4e70cf3983f43::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
