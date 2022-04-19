<?php

namespace Core;

use Controller\AddressController;
use Core\Route\Router;

class App
{
    public static string $baseCsv;

    public static function setup(): void
    {
        /**
         * Setup application routing
         */
        Router::get('/address', AddressController::class, 'ex');

        /**
         * Set base path for csv
         */
        self::$baseCsv = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'Datasets';
    }
}