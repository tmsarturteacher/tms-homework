<?php

require_once "vendor/autoload.php";

use App\Database;

class DoRegister {
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    public function register(array $post): bool
    {
        $username = isset($post['username']) ? htmlspecialchars($post['username']) : null;
        $password = isset($post['password']) ? htmlspecialchars($post['password']) : null;

        if ($username && $password) {
            try {
                $statement = $this->db->connection()->prepare("
                    INSERT INTO users (username, password) VALUES (:username, :password)
                ");

                $statement->execute([
                    'username' => $username,
                    'password' => $password
                ]);
            } catch (PDOException $e) {
                return false;
            }

        } else {
            return false;
        }

        return true;
    }
}

$register = new DoRegister();
if ($register->register($_POST)) {
    echo "User added!";
} else {
    echo "User added error!";
}