<?php

function autoloader($className) {
    $fileName = str_replace('\\', '/', strtolower($className)) . '.php';
    $file = __DIR__ . '/' . $fileName;
    include $file;
}

spl_autoload_register('autoloader');

?>