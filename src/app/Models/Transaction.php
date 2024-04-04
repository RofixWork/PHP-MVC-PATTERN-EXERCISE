<?php

namespace App\Models;

class Transaction extends Model
{
    public function get() : array
    {
        $query = "SELECT * FROM transactions;";

        return $this->db->query($query)->fetchAll();
    }
}