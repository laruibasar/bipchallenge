<?php

namespace Core\Route;

use Core\Http\HttpMethod;
use Core\Http\HttpResponse;
use Core\Http\Request;

class Router
{
    /**
     * Store all routes for HTTP GET
     * @var array
     */
    private static array $httpGet = [];

    /**
     * Store all routes for HTTP POST
     * @var array
     */
    private static array $httpPost = [];

    /**
     * Store all routes for HTTP PUT
     * @var array
     */
    private static array $httpPut = [];

    /**
     * Store all routes for HTTP DELETE
     * @var array
     */
    private static array $httpDelete = [];

    /**
     * Add entry to GET array
     * @param string $path
     * @param string $controller
     * @param string $method
     * @return void
     */
    public static function get(string $path, string $controller, string $method = 'get'): void
    {
        self::$httpGet[] = new Route($path, $controller, $method);
    }

    /**
     * Add entry to POST array
     * @param string $path
     * @param string $controller
     * @param string $method
     * @return void
     */
    public static function post(string $path, string $controller, string $method = 'post'): void
    {
        self::$httpPost[] = new Route($path, $controller, $method);
    }

    /**
     * Add entry to PUT array
     * @param string $path
     * @param string $controller
     * @param string $method
     * @return void
     */
    public static function put(string $path, string $controller, string $method = 'put'): void
    {
        self::$httpPut[] = new Route($path, $controller, $method);
    }

    /**
     * Add entry to DELETE array
     * @param string $path
     * @param string $controller
     * @param string $method
     * @return void
     */
    public static function delete(string $path, string $controller, string $method = 'delete'): void
    {
        self::$httpDelete[] = new Route($path, $controller, $method);
    }

    /**
     * Find and execute the controller specific for the route.
     * @param Request $request
     * @return HttpResponse
     * @throws RouteNotFoundException
     */
    public static function route(Request $request): HttpResponse
    {
        $httpMethod = $request->getMethod();
        $routes = match ($httpMethod) {
            HttpMethod::GET => self::$httpGet,
            HttpMethod::POST => self::$httpPost,
            HttpMethod::PUT => self::$httpPut,
            HttpMethod::DELETE => self::$httpDelete,
        };

        $routing = null;
        $path = $request->getPath();
        foreach ($routes as $route) {
            if ($route->match($path)) {
                $routing = $route;
            }
        }

        if (is_null($routing)) {
            throw new RouteNotFoundException(
                strtoupper($request->getMethod()->name) . " " . $request->getPath() . " not found"
            );
        }
        $controllerName = $route->getController();
        $controller = new $controllerName;

        return $controller->{$route->getMethod()}($request);
    }
}