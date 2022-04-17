<?php

function autoLoader($className)
{
    $extension = spl_autoload_extensions();
    $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
    $filename = __DIR__ . DIRECTORY_SEPARATOR . $className . $extension;

    if (is_readable($filename)) {
        require_once($filename);
    } else {
        die("Class not found: $filename" . PHP_EOL);
    }
}

spl_autoload_extensions('.php');
spl_autoload_register('autoLoader');