<?php

namespace Core;

class Authenticator {
    public function attempt($username, $password) {
        // Find the user.
        $user = App::resolve('Core\Database')
            ->query('select * from users where email = :email',
            ['email' => $email
        ])->find();

        // Attempt the user.
        if ($user) {
            // verify if the password matches.
            if (password_verify($password, $user['password'])) {
                $this->login([
                    'email' => $email,
                ]);

                return true;
            }
        }

        return false;

    }

    public function login($user) {
        $_SESSION['user'] = [
            'email' => $user['email'],
        ];

        // regenerate the id of the session to make having fully new session when login after logout!
        session_regenerate_id(true);
    }

    public function logout() {
        $_SESSION = [];
        session_destroy();

        $params = session_get_cookie_params();
        setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }
}