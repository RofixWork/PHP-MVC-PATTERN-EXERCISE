<?php
declare(strict_types=1);

namespace App;

use App\Exceptions\ViewNotFoundException;

class View
{
    protected string $view;
    protected array $params;
    public function __construct(string $view, array $params = [])
    {
        $this->view = $view;
        $this->params = $params;
    }

    /**
     * @throws ViewNotFoundException
     */
    public function render() : string
    {
        $filePath = VIEW_PATH . "/$this->view.php";

        if(!file_exists($filePath))
        {
            throw new ViewNotFoundException();
        }
        ob_start();
        include $filePath;
        return ob_get_clean();
    }

    public static function make(string $view, array $params = []) : View
    {
        return new static($view, $params);
    }

    /**
     * @throws ViewNotFoundException
     */
    public function __toString(): string
    {
        return $this->render();
    }

    public function __get(string $name)
    {
        return $this->params[$name] ?? null;
    }
}