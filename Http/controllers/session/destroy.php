<?php

// log the user out.
use Core\Authenticator;

$auth = new Authenticator();

$auth->logout();

header('location: /');
exit();