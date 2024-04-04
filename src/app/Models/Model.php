<?php

namespace App\Models;

use App\App;

abstract class Model
{
    protected \PDO $db;

    public function __construct()
    {
        $this->db = App::db();
    }

}