<?php

use Core\Validator;
use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$errors = [];

// Not needed cuz of static
// $validator = new Validator();

if (! Validator::string($_POST['body'], 1, 1000)){
    $errors['body'] = 'A body of no more than 1000 characters is required';
}

if (! empty($errors)){
    // Validation issue
    return view('notes/create.view.php', [
        'heading' => 'Create Note',
        'errors' => $errors
    ]);
}

$db->query('INSERT INTO notes (body, user_id) VALUES (:body, :user_id)', [
    // A problem of inserting HTML or JS in the Body textarea!!
    // solved w/ htmlspecialchars() function
    ':body' => $_POST['body'],
    ':user_id' => 1
]);

header('Location: /notes');
die();
