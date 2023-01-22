<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;
use App\Views\View;
use Exception;

class UserController extends Controller
{
    /**
     * Login form.
     *
     * @return string
     * @throws Exception
     */
    public function loginForm(): string
    {
        if (isset($_SESSION['user'])) {
            header('Location: /');
        }

        return View::make('users/login')->render();
    }

    /**
     * User login.
     *
     * @throws Exception
     */
    public function login()
    {
        $data['userName'] = $_POST['userName'] ?? '';
        $data['userPassword'] = $_POST['userPassword'] ?? '';

        // Validation
        if (!empty($this->validationErrors($data))) {
            return View::make('users/login')->render();
        }

        // Authorization
        $user = (new User())->loginAttempt($data['userName'], $data['userPassword']);
        if (!$user) {
            $errors[] = 'Wrong credentials. Try again, please.';
            $_SESSION['flash']['validateErrors'] = $errors;
            return View::make('users/login')->render();
        }

        $_SESSION['user'] = [
            'user_id' => $user['id'],
            'is_admin' => $user['is_admin'],
        ];

        header('Location: /');
    }

    /**
     * User logout.
     *
     * @return void
     */
    public function logout(): void
    {
        unset($_SESSION['user']);
        session_destroy();
        header('Location: /user/login');
    }
}
