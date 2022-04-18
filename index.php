
<?php

require_once 'autoload.php';

use Core\App;
use Core\Http\HttpResponse;
use Core\Http\HttpMethodException;
use Core\Http\JsonResponse;
use Core\Http\Request;
use Core\Route\Router;
use Core\Route\RouteNotFoundException;

/*
 * Configure application
 */
App::setup();

/*
 * Build a request with information from server
 */
try {
    $request = new Request();
} catch (HttpMethodException $hmex) {
    $error = (object)['error' => $hmex->getMessage()];
    echo new JsonResponse($error, HttpResponse::HTTP_NOT_IMPLEMENTED);
    die;
}

/*
 * Process request according to the routing information
 */
try {
    $response = Router::route($request);
} catch (RouteNotFoundException $rex) {
    $error = (object)['error' => $rex->getMessage()];
    $response = new JsonResponse($error, HttpResponse::HTTP_NOT_FOUND);
} catch (Exception $ex) {
    $error = (object)['error' => $ex->getMessage()];
    $response = new JsonResponse($error, HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
}

/*
 * Output response
 */
echo $response;

?>
