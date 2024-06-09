<?php

use Core\App;
// use Core\Database;

//$config = require base_path('config.php');
//$db = new Database($config['database']);

// $db = App::container()->resolve('Core\Database');
$db = App::resolve('Core\Database');

$currentUserId = 1;

$note = $db -> query('select * from notes where id = :id', [
    'id' => $_POST['id']
])->findOrFail();

authorized($note['user_id'] === $currentUserId);

$db->query('DELETE FROM notes WHERE id = :id', [
    ':id' => $_POST['id']
]);

header('Location: /notes');
exit();