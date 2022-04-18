<?php

namespace Core\Http;

class Request
{
    private readonly HttpMethod $method;

    private readonly string $path;

    private readonly array $params;

    public function __construct()
    {
        $this->method = HttpMethod::getMethod($_SERVER['REQUEST_METHOD']);
        $this->path = $_SERVER['PATH_INFO'] ?? '/';
        $this->params = $_REQUEST ?? [];
    }

    /**
     * @return \Core\Http\HttpMethod
     */
    public function getMethod(): \Core\Http\HttpMethod
    {
        return $this->method;
    }

    /**
     * @return mixed|string
     */
    public function getPath(): mixed
    {
        return $this->path;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function getParam(string $name): mixed
    {
        return $this->params[$name] ?? '';
    }
}
