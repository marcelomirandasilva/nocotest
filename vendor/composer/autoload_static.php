<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitbf5c594aefa24f5fb8573b28adb1a289
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Faker\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Faker\\' => 
        array (
            0 => __DIR__ . '/..' . '/fzaninotto/faker/src/Faker',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitbf5c594aefa24f5fb8573b28adb1a289::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitbf5c594aefa24f5fb8573b28adb1a289::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitbf5c594aefa24f5fb8573b28adb1a289::$classMap;

        }, null, ClassLoader::class);
    }
}
