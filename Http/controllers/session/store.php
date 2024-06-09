<?php

// log in the user if the credentials match.

use Core\App;
use Core\Validator;
use Http\Forms\LoginForm;

$email = $_POST['email'];
$password = $_POST['password'];
$db = App::resolve('Core\Database');

$form = new LoginForm();

if (!$form->validate($email, $password)) {
    return view('session/create.view.php', [
        'errors' => $form->errors()
    ]);
}

// Match the credentials.
$user = $db->query('select * from users where email = :email',
    ['email' => $email
])->find();


if ($user) {
    // verify if the password matches.
    if (password_verify($password, $user['password'])) {
        login([
            'email' => $email,
        ]);

        header('location: /');
        exit();
    }
}

return view('session/create.view.php', [
    'errors' => [
        'email' => 'No matching account for that email and password.'
    ]
]);