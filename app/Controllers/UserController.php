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
        return View::make('users/login')->render();
    }

    /**
     * Handle user login.
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
        if (!empty($this->authErrors($data))) {
            return View::make('users/login')->render();
        }

//        $_SESSION['user_id'] = $user->id;
        header('Location: /');
    }

    private function authErrors(array $data): array
    {
        $errors = [];

        $user = new User();
        if (!$user->checkCredentials($data['userName'], $data['userPassword'])) {
            $errors[] = 'Wrong credentials. Try again, please.';
        }

        $_SESSION['flash']['validateErrors'] = $errors;

        return $errors;
    }
}
