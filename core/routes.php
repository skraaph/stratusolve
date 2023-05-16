<?php

$Router->get('/', 'index.php')->access('auth');
$Router->get('/account', 'account.php')->access('auth');
$Router->get('/login', 'login.php')->access('guest');

$Uri = parse_url($_SERVER['REQUEST_URI'])['path'];