<?php

require 'functions.php';
require 'router.php';

require 'Database.php';

$config = require('config.php');

$db = new Database($config['database']);

$id = $_GET['id'];
// letting the id unknown,
$query = "select * from posts where id = :id"; // Don't ever ever ever accept user input and inline it as a part of the (database query)!
// and pass it as a parameter in the query method
$posts = $db->query($query, [':id' => $id])->fetch();
// to keep it separately, and secure!