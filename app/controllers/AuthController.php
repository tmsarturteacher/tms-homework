<?php

namespace App\Controller;

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Sessions;
use PDOException;

class AuthController extends Controller
{
    public function loginForm(): void
    {
        echo $this->view->run('login', []);
    }
    
    public function login()
    {
        $username = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : null;
        $password = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : null;

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

    public function registerForm()
    {
        
    }

    public function register()
    {
        
    }
}