<?php

// find the corresponding note

// authorize that the current user can edit

// validate the form

// if validation errors, return the edit view.

// else update the record in the notes database table.

// redirect the user



use Core\App;
use Core\Validator;
// use Core\Database;

$db = App::resolve('Core\Database');

$currentUserId = 1;


// find the corresponding note
$note = $db -> query('select * from notes where id = :id', [
    'id' => $_POST['id']
])->findOrFail();


// authorize that the current user can edit
authorized($note['user_id'] === $currentUserId);

$errors = [];


// validate the form
if (! Validator::string($_POST['body'], 1, 1000)){
    $errors['body'] = 'A body of no more than 1000 characters is required';
}


// if validation errors, return the edit view.
if (count($errors)){
    return view('notes/create.view.php', [
        'heading' => 'Create Note',
        'errors' => $errors,
        'note' => $note
    ]);
}


// else update the record in the notes database table.
$db->query('update notes set body = :body where id = :id', [
    'id' => $_POST['id'],
    'body' => $_POST['body']
]);


// redirect the user
header('location: /notes');
die();