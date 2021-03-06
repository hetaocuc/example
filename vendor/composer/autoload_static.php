<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitdf8a9bcc67eb02f265e6eb2bb4ddd4ed
{
    public static $prefixLengthsPsr4 = array (
        'a' => 
        array (
            'app\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitdf8a9bcc67eb02f265e6eb2bb4ddd4ed::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitdf8a9bcc67eb02f265e6eb2bb4ddd4ed::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitdf8a9bcc67eb02f265e6eb2bb4ddd4ed::$classMap;

        }, null, ClassLoader::class);
    }
}
