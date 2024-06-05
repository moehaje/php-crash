<?php

use Core\Database;
use Core\Validator;

require base_path('Core/Validator.php');

$config = require base_path('config.php');
$db = new Database($config['database']);

$heading = 'Create Note';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    // Not needed cuz of static
    // $validator = new Validator();

    if (! Validator::string($_POST['body'], 1, 1000)){
        $errors['body'] = 'A body of no more than 1000 characters is required';
    }

    if (empty($errors)){
        $db->query('INSERT INTO notes (body, user_id) VALUES (:body, :user_id)', [
            // A problem of inserting HTML or JS in the Body textarea!!
            // solved w/ htmlspecialchars() function
            ':body' => $_POST['body'],
            ':user_id' => 1
        ]);
    }
}


//if ($_SERVER["REQUEST_METHOD"] === "POST") {
//    dd($_POST);
//}

require view('notes/create.view.php', [
    'heading' => 'Create Note',
    'errors' => $errors
]);