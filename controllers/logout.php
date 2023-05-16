<?php

session_start();

use Core\Classes\Authenticator;
use Core\Classes\Session;

require '../core/classes/authenticator.php';
require '../core/classes/session.php';

(new Authenticator)->logout();