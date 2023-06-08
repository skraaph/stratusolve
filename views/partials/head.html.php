<?php //require('partials/head.php') ?>
<?php unset($_SESSION['post']['start_post_id']); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="assets/js/jquery-3.6.4.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/account.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="assets/css/account.css">
    <title>Document</title>
</head>

<body>
    <div class="app">
        <!-- Left -->
        <div class="aside-left">
            <div class="aside-container">
                <div class="aside-top">
                    <div class="logo-item">
                        <span>BLOG</span>
                    </div>
                    <div class="nav-item">
                        <a href="./">
                            <div class="menu-item" id="home">
                                <div class="menu-item-img">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-house" viewBox="0 0 16 16">
                                        <path
                                            d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5ZM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5 5 5Z" />
                                    </svg>
                                </div>
                                <div class="menu-item-text">
                                    <span>Home</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="account">
                            <div class="menu-item" id="account">
                                <div class="menu-item-img">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-person-circle" viewBox="0 0 16 16">
                                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                        <path fill-rule="evenodd"
                                            d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                                    </svg>
                                </div>
                                <div class="menu-item-text">
                                    <span>Account</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="account-item">
                    <div class="account-item-img">
                        <img src="assets/uploads/<?= $_SESSION['user']['img']?>" alt="">
                    </div>
                    <a><?php echo $_SESSION['user']['user_full']; ?></a>
                </div>
                <ul class="account-menu">
                    <li class="account-menu-btn">Log out</li>
                </ul>
            </div>
        </div>