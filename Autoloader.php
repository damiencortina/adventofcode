<?php

class Autoloader{

    static function register(): void
    {
        spl_autoload_register(function($class) {
            $path = str_replace('\\', DIRECTORY_SEPARATOR, $class);
            require 'src/' . $path . '.php';
        });
    }

}