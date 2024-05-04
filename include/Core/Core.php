<?php

namespace Inc\Core;

final class Core
{
    // Loop through the classes, initialize them, and call the register method if exists
    public static function register_services()
    {
        foreach (self::get_services() as $class) {
            $service = self::instance($class);

            if (method_exists($service, 'register')) {
                $service->register();
            }
        }
    }


    // Store all the classes in an array
    public static function get_services(): array
    {
        return [
            Base\Enqueue::class,
        ];
    }

    // Initialize the class
    private static function instance($class)
    {
        return new $class;
    }
}
