<?php

namespace Core\Http;

enum HttpMethod
{
   case GET;
   case POST;
   case PUT;
   case DELETE;

   public static function getMethod(string $method): HttpMethod
   {
       return match ($method) {
           'GET' => HttpMethod::GET,
           'POST' => HttpMethod::POST,
           'PUT' => HttpMethod::PUT,
           'DELETE' => HttpMethod::DELETE
       };
   }
}