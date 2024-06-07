<?php

const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . 'Core/functions.php';

spl_autoload_register(function ($class) {
    // Core\Database
    $class = str_replace( '\\', DIRECTORY_SEPARATOR, $class);
    // dd(base_path($class . '.php'));
    require base_path("{$class}.php");
});

require base_path('bootstrap.php');

$router = new \Core\Router();
$routes = require base_path('routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = isset($_POST['_method']) ? $_POST['_method'] : $_SERVER['REQUEST_METHOD'];

$router->route($uri, $method);










//$id = $_GET['id'];
//// letting the id unknown,
//$query = "select * from posts where id = :id"; // Don't ever ever ever accept user input and inline it as a part of the (database query)!
//// and pass it as a parameter in the query method
//$posts = $db->query($query, [':id' => $id])->fetch();
//// to keep it separately, and secure!