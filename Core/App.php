<?php

namespace Core;

use Controller\AddressController;
use Core\Route\Router;

class App
{
    public static function setup(): void
    {
        /**
         * Setup application routing
         */
        Router::get('/address', AddressController::class, 'ex');
    }
}