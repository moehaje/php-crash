<?php

use Core\App;
// use Core\Database;

$db = App::resolve('Core\Database');

$currentUserId = 1;

$note = $db -> query('select * from notes where id = :id', [
    'id' => $_GET['id']
])->findOrFail();

authorized($note['user_id'] === $currentUserId);

view('notes/edit.view.php', [
    'heading' => 'Edit Note',
    'errors' => [],
    'note' => $note
]);


//if ($_SERVER["REQUEST_METHOD"] === "POST") {
//    dd($_POST);
//}