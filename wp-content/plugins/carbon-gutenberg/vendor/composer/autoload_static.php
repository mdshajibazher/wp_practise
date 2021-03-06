<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitbd111c2af1ba30847a27a50541a7fcb0
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Carbon_Fields\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Carbon_Fields\\' => 
        array (
            0 => __DIR__ . '/..' . '/htmlburger/carbon-fields/core',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitbd111c2af1ba30847a27a50541a7fcb0::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitbd111c2af1ba30847a27a50541a7fcb0::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitbd111c2af1ba30847a27a50541a7fcb0::$classMap;

        }, null, ClassLoader::class);
    }
}
