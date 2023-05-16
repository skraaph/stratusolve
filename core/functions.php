<?php

function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}

function getBasePath($path)
{
    return BASE_PATH . $path;
}

function view($Path, $Attributes = [])
{
    extract($Attributes);

    require getBasePath('views/' . $Path);
}

function redirect($path)
{
    header("location: {$path}");
    exit();
}

// function old($key, $default = '')
// {
//     return Core\Session::get('old')[$key] ?? $default;
// }

function sanitizeInput($Input) {
    $Input = htmlspecialchars($Input);
    $Input = trim($Input);
    //$Input = stripslashes($Input);
    return $Input;
}