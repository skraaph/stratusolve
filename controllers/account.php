<?php

view("account.html.php", [
    'heading' => 'Account',
    'ViewUserFirstNameStr' => $_SESSION['user']['user_firstname'],
    'ViewUserLastNameStr' => $_SESSION['user']['user_lastname'],
    'ViewUsernameStr' => $_SESSION['user']['username']
]);