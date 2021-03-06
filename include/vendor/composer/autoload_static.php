<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit34e6f2ce7fb63ead6dfd8b5a60aedd10
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit34e6f2ce7fb63ead6dfd8b5a60aedd10::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit34e6f2ce7fb63ead6dfd8b5a60aedd10::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit34e6f2ce7fb63ead6dfd8b5a60aedd10::$classMap;

        }, null, ClassLoader::class);
    }
}
