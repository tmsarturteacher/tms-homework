<?php

require_once 'vendor/autoload.php';

use App\Database;
use App\Sessions;

class DoLogin {
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function login($post)
    {
        $username = isset($post['username']) ? htmlspecialchars($post['username']) : null;
        $password = isset($post['password']) ? htmlspecialchars($post['password']) : null;

        if ($username && $password) {
            try {
                $statement = $this->db->connection()->prepare("
                    SELECT * FROM users WHERE username = :username
                ");

                $statement->execute([
                    'username' => $username
                ]);

                $user = $statement->fetch();

                if ($user && count($user)) {
                    if ($user['password'] === $password) {
                        $session = new Sessions();
                        $session->start();
                        $session->set('user_id', $user['id']);
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }

            } catch (PDOException $e) {
                return false;
            }

        } else {
            return false;
        }

        return true;
    }
}

$login = new DoLogin();
if ($login->login($_POST)) {
    echo "User login!";
} else {
    echo "User login error!";
}