<?php

use Core\App;
use Core\Validator;

$email = $_POST['email'];
$password = $_POST['password'];

// validate the form inputs

// check if the account already exist
    // if yes, redirect to login page
    // ifn not, save on to the database, and then log the user in, and redirect.


// validate the form inputs
$errors = [];
if (!Validator::email($email)) {
    $errors['email'] = 'Please enter a valid email address';
}

if (!Validator::string($email, 7, 255)) {
    $errors['password'] = 'Please enter a password at least 7 characters long';
}

if (!empty($errors)) {
    return view('registration/create.view.php', [
        'errors' => $errors
    ]);
}


$db = App::resolve('Core\Database');

// check if the account already exist
$user = $db->query('select * from users where email = :email', [
    'email' => $email
])->find();

// someone with that email already exists and has an account.
if ($user) {
    // if yes, redirect to login page
    header('Location: /');
    exit();
} else {
    // if not, save on to the database, and then log the user in, and redirect.
    $db->query('INSERT INTO users (email, password) VALUES (:email, :password)', [
        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT)
    ]);

    // mark that the user has logged in!
    $_SESSION['user'] = [
        'email' => $email,
    ];

    header('location: /');
    exit();
}








//view('registration/create.view.php', [
//    'heading' => 'Registration',
//]);