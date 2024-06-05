<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$currentUserId = 1;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $note = $db -> query('select * from notes where id = :id', [
        'id' => $_GET['id']
    ])->findOrFail();

    authorized($note['user_id'] === $currentUserId);

    // form was submitted. delete the current note

    $db->query('DELETE FROM notes WHERE id = :id', [
        ':id' => $_POST['id']
    ]);

    header('Location: /notes');
    exit();

} else {

    $note = $db -> query('select * from notes where id = :id', [
        'id' => $_GET['id']
    ])->findOrFail();

    authorized($note['user_id'] === $currentUserId);

    require view('notes/show.view.php', [
        'heading' => 'Note',
        'note' => $note,
    ]);

}