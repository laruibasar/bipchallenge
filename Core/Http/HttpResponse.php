<?php

namespace Core\Http;

abstract class HttpResponse
{
    public const HTTP_OK = 200;
    public const HTTP_CREATED = 201;
    public const HTTP_NO_CONTENT = 204;
    public const HTTP_BAD_REQUEST = 400;
    public const HTTP_FORBIDDEN = 403;
    public const HTTP_NOT_FOUND = 404;
    public const HTTP_INTERNAL_SERVER_ERROR = 500;
    public const HTTP_NOT_IMPLEMENTED = 501;

    public static $statusTexts = [
        200 => 'Continue',
        201 => 'Created',
        204 => 'No Content',
        400 => 'Bad Request',
        403 => 'Forbidden',
        404 => 'Not Found',
        500 => 'Internal Server Error',
        501 => 'Not Implemented'
    ];

    protected array $headers;

    protected int $statusCode;

    protected string $content;

    protected string $statusText;

    public function __construct(?string $content = '', int $status = 200, array $headers = [])
    {
        $this->headers = $headers;
        $this->content = $content;
        $this->statusCode = $status;
        $this->statusText = self::$statusTexts[$status];
    }

    /**
     * Set custom HTTP headers for the response.
     * @return void
     */
    protected function sendHeaders(): void
    {
        foreach ($this->headers as $name => $value) {
            header(sprintf('%s: %s', ucwords($name, '-'), $value));
        }
    }
}
