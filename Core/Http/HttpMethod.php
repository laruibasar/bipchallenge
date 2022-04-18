<?php

namespace Core\Http;

enum HttpMethod
{
   case GET;
   case POST;
   case PUT;
   case DELETE;

    /**
     * Get the object representing the HTTP Request type
     * @param string $method
     * @return HttpMethod|null
     * @throws HttpMethodException
     */
   public static function getMethod(string $method): ?HttpMethod
   {
       return match ($method) {
           'GET' => HttpMethod::GET,
           'POST' => HttpMethod::POST,
           'PUT' => HttpMethod::PUT,
           'DELETE' => HttpMethod::DELETE,
           default => throw new HttpMethodException("HTTP Method $method not handled"),
       };
   }
}