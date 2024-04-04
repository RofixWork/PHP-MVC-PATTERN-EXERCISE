<?php

namespace App;

use App\Exceptions\RouteNotFoundException;
use Couchbase\PathNotFoundException;

class Router
{
    private array $routes = [];

    private function register(string $http_method, string $route, callable|array $action) : self
    {
        $this->routes[$http_method][$route] = $action;
        return $this;
    }

    public function get(string $route, callable|array $action) : self
    {
        $this->register("get", $route, $action);
        return $this;
    }

    public function post(string $route, callable|array $action) : self
    {
        $this->register("post", $route, $action);
        return $this;
    }

    /**
     * @throws RouteNotFoundException
     */
    public function resolve(string $requestUri, string $requestMethod) : string
    {
        $route = explode("?", $requestUri)[0];
        $action = $this->routes[$requestMethod][$route] ?? null;

        if(!$action)
        {
            throw new RouteNotFoundException();
        }

        if(is_callable($action))
        {
            return call_user_func($action);
        }

        if(is_array($action))
        {
            [$class, $method] = $action;

            if(class_exists($class))
            {
                $class = new $class;

                if(method_exists($class, $method))
                {
                    return call_user_func_array([$class, $method], []);
                }
            }
        }

        throw new RouteNotFoundException();

    }

    public function printRoutes()
    {
        echo "<pre>";
        var_dump($this->routes);
        echo "</pre>";
    }
}