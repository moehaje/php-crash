<?php

// log in the user if the credentials match.

use Core\Authenticator;
use Core\Session;
use Http\Forms\LoginForm;

$email = $_POST['email'];
$password = $_POST['password'];

$form = new LoginForm();

if ($form->validate($email, $password)) {

    $auth = new Authenticator();

    if ($auth->attempt($email, $password)) {
        redirect('/');
    } else {
        $form->addError('email', 'No matching account for that email and password.');
    }
}

Session::flash('errors', $form->errors());
Session::flash('old', [
    'email' => $email,
    'password' => $password
]);

return redirect('/login');