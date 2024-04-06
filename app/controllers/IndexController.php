<?php

namespace App\Controller;

use App\Sessions;

class IndexController
{
    public function index()
    {

        $session = new Sessions();
        $session->start();

//        $session->unset('user_id');

        $issetUser = $session->get('user_id');

        if ($issetUser) {
            echo "Управление новостями!<br />";
            echo "<a href='#'>Создать новость</a>";
        } else {
            echo "<a href='/login'>Login</a> | ";
            echo "<a href='/register'>Register</a>";
        }
    }
}