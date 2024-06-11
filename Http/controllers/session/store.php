<?php

use Core\Authenticator;
use Http\Forms\LoginForm;

// if passed, then no exception were thrown!
$form = LoginForm::validate($attributes = [
    'email' => $_POST['email'],
    'password' => $_POST['password']
]);

$signedIn = (new Authenticator)->attempt(
    $attributes['email'], $attributes['password']
);

if (!$signedIn) {
    $form->addError(
        'email', 'No matching account for that email and password.'
    )->throw();
}

redirect('/');





