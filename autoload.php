<?php

require __DIR__ . '/vendor/autoload.php';

function my_autoload($class)
{
        $classParts = explode('\\', $class);
        $classParts[0] = __DIR__;
        $path = implode(DIRECTORY_SEPARATOR, $classParts) . '.php';
        if(file_exists($path))
        {
           // var_dump($path);
            require $path;
        }
}

spl_autoload_register('my_autoload');


/*
if (file_exists(__DIR__ . '/controllers/' . $class . '.php')){
        require __DIR__ . '/controllers/' . $class . '.php';
    } elseif (file_exists(__DIR__ . '/models/' . $class . '.php')){
        require __DIR__ . '/models/' . $class . '.php';
    } elseif (file_exists(__DIR__ . '/classes/' . $class . '.php')){
        require __DIR__ . '/classes/' . $class . '.php';
 */