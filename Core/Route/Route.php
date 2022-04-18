<?php

namespace Core\Route;

use Controller\Controller;

class Route
{
    private string $path;

    private string $controller;

    private string $method;

    public function __construct(string $path, string $controller, string $method)
    {
       $this->path = $path;
       $this->controller = $controller;
       $this->method = $method;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return Controller
     */
    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * Check if a path belongs to the Route object
     * @param string $path
     * @return bool
     */
    public function match(string $path): bool
    {
        return strcasecmp($path, $this->path) === 0;
    }
}