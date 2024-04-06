<?php

namespace App\Controller;

use App\Database;
use eftec\bladeone\BladeOne;

class Controller
{
    protected BladeOne|string $view = '';
    protected Database $db;
    public function __construct()
    {
        $views = __DIR__ . '/../../views';
        $cache = __DIR__ . '/../../cache';
        $this->view = new BladeOne($views,$cache,BladeOne::MODE_DEBUG); // MODE_DEBUG allows to pinpoint troubles.

        $this->db = new Database();
    }
}