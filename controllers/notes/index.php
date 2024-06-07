<?php

use Core\App;
// use Core\Database;

//$config = require base_path('config.php');
//$db = new Database($config['database']);

$db = App::resolve('Core\Database');
$notes = $db->query('select * from notes where user_id = 1')->get();


require view('notes/index.view.php', [
    'heading' => 'My Notes',
    'notes' => $notes,
]);