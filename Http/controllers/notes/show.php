<?php

use Core\App;
// use Core\Database;

$db = App::resolve('Core\Database');

$currentUserId = 1;

$note = $db -> query('select * from notes where id = :id', [
    'id' => $_GET['id']
])->findOrFail();

authorized($note['user_id'] === $currentUserId);

require view('notes/show.view.php', [
    'heading' => 'Note',
    'note' => $note,
]);