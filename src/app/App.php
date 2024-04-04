<?php
declare(strict_types=1);
namespace App;
use App\Exceptions\RouteNotFoundException;
use PDO;
class App
{
    private Router $router;
    private string $requestUri;
    private string $requestMethod;

    private static PDO $pdo;

    public function __construct(Router $router, string $requestUri, string $requestMethod, Config $config)
    {
        $this->router = $router;
        $this->requestUri = $requestUri;
        $this->requestMethod = $requestMethod;

        try {
            static::$pdo = new PDO("mysql:host=$config->host;dbname=$config->database", $config->username, $config->password, [
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
            ]);
        } catch (\PDOException $PDOException)
        {
            throw new \PDOException($PDOException->getMessage(), $PDOException->getCode());
        }
    }

    /**
     * @throws RouteNotFoundException
     */
    public function run(): void
    {
        echo $this->router->resolve($this->requestUri, strtolower($this->requestMethod));
    }

    public static function db() : PDO
    {
        return static::$pdo;
    }
}