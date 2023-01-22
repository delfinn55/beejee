<?php

namespace App\Core;

class Controller
{
    /**
     * Validation for task creation.
     *
     * @param $data
     * @return array
     */
    protected function validationErrors($data): array
    {
        $errors = [];

        // Email
        if (isset($data['userEmail']) && empty($data['userEmail'])) {
            $errors[] = 'User email is required';
        }
        if (isset($data['userEmail']) && !filter_var($data['userEmail'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Invalid email address';
        }

        // Name
        if (isset($data['userName']) && empty($data['userName'])) {
            $errors[] = 'User name is required';
        }
        if (isset($data['userName']) && !preg_match ("/^[0-9a-zA-z]*$/", $data['userName'])) {
            $errors[] = 'Not valid name. Use alphabets and numbers only';
        }

        // Password
        if (isset($data['userPassword']) && empty($data['userPassword'])) {
            $errors[] = 'Password is required';
        }

        // Description
        if (isset($data['taskDescription']) && empty($data['taskDescription'])) {
            $errors[] = 'Description is required';
        }
        if (isset($data['taskDescription']) && strlen($data['taskDescription']) < 3) {
            $errors[] = 'Description must be at least 3 characters';
        }

        $_SESSION['flash']['errors'] = $errors;

        return $errors;
    }
}