<?php

view("index.html.php", [
    'heading' => 'Home',
    'img' => $_SESSION['user']['img']
]);