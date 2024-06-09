<?php

$_SESSION['name'] = 'Jeffrey';

require view('index.view.php', [
    'heading' => 'Home',
]);