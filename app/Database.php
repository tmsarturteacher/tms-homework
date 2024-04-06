<?php

namespace App;

use Exception;
use PDO;

class Database
{
    private PDO $db;
    public function __construct()
    {
        $config = require 'config.php';
        $dsn = 'mysql:host='.$config['db_host'].';dbname='.$config['db_name'].';port=33306';
        try {
            $this->db = new PDO($dsn, $config['db_user'], $config['db_password']);
        } catch (Exception $e) {
            die("Database error! " . $e->getMessage());
        }

        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    public function connection()
    {
        return $this->db;
    }
}