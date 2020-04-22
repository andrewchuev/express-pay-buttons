<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1c0b37d211d6e3bc3704c57251fe00c1
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Stripe\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Stripe\\' => 
        array (
            0 => __DIR__ . '/..' . '/stripe/stripe-php/lib',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit1c0b37d211d6e3bc3704c57251fe00c1::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1c0b37d211d6e3bc3704c57251fe00c1::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}