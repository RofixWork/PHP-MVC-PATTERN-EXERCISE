<?php
declare(strict_types=1);
namespace App;
class Config
{
    private array $configurations = array();

    public function __construct(array $env)
    {
        $this->configurations = [
            'db' => [
                'host' => $env['DB_HOST'],
                'database' => $env['DB_DATABASE'],
                'username' => $env['DB_USERNAME'],
                'password' => $env['DB_PASSWORD'],
            ]
        ];
    }

    public function __get(string $name)
    {
        return $this->configurations["db"][$name] ?? null;
    }
}
