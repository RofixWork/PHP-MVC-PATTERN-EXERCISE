<?php
namespace App\Exceptions;
class ViewNotFoundException extends \Exception
{

    protected $message = "This View Not Found (404)";
}