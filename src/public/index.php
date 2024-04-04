<?php
declare(strict_types=1);



use App\App;
use App\Controllers\HomeController;
use App\Router;
const VIEW_PATH = __DIR__ . "/../Views";
include __DIR__ . "/../vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$router = new Router();
$router->get("/", [HomeController::class, 'index']);


try {
    (new App(
        $router,
        $_SERVER["REQUEST_URI"],
        $_SERVER["REQUEST_METHOD"],
        new \App\Config($_ENV)
    ))->run();
} catch (\App\Exceptions\RouteNotFoundException $e) {
    echo \App\View::make("error/404");
}

//$router->printRoutes();

//echo "<pre>";
//var_dump($_SERVER);
//echo "</pre>";
