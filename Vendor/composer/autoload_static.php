<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit21b79ca42a18ccda4c9a544db3acf3b4
{
    public static $prefixesPsr0 = array (
        'E' => 
        array (
            'Embera' => 
            array (
                0 => __DIR__ . '/..' . '/mpratt/embera/Lib',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInit21b79ca42a18ccda4c9a544db3acf3b4::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
