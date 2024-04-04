<?php

namespace App\Exceptions;

class RouteNotFoundException extends \Exception
{
    protected $message = "This Route Not Found (404)";
}