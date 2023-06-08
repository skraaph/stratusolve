<?php //unset($_SESSION['post']['start_post_id']); ?>
<?php require('partials/head.html.php') ?>

<!-- Main -->
<div class="main">
    <div id="myModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <p class="close">&times;</p>
                <h1>Done!</h1>
            </div>
            <span>Changes have been saved</span>
        </div>
    </div>
    <div id="myModal2" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <p class="close">&times;</p>
                <h1>Done!</h1>
            </div>
            <span> Password has been changed </span>
        </div>
    </div>
    <div class="main-header">
        <span>Account</span>
    </div>
    <div class="acc-forms">
        <form class="acc-img-change" action="handlers/handle_userimage.php" method="post">
            <div>
                <div class="acc-img">
                    <img id="previewImage" src="assets/uploads/<?= $_SESSION['user']['img']?>" alt="">
                    <input type="file" name="file" id="file" class="inputfile" />
                    <div class="inputfile-label">
                        <label for="file">Choose <br> a file</label>
                    </div>
                    <!-- <input type="file" name="fileToUpload" id="fileToUpload"> -->
                    <button>change image</button>
                </div>
                <div class="acc-img-error" id="acc-img-error">
                    <span>Looks good!</span>
                </div>
            </div>
            <div class="acc-img-info">
                <span>* Only png files up to 100Kb are allowed</span>
            </div>
        </form>
        <div style="width: 4px;"></div>
        <div class="acc-change2">
            <form action="handlers/handle_userchange.php" method="post" class="acc-change">
                <div class="acc-img-inp">
                    <div class="acc-data">
                        <div class="acc-firstname">
                            <span>First Name:</span>
                            <div class="acc-change-item">
                                <input class="text-only required" type="text" id="acc-firstname"
                                    value="<?=$ViewUserFirstNameStr ?>" placeholder="First Name" autocomplete="off">
                                <div class="acc-firstname-error" id="acc-firstname-error">
                                    <span>Looks good!</span>
                                </div>
                            </div>
                        </div>
                        <div class="acc-lastname">
                            <span>Last Name:</span>
                            <div class="acc-change-item">
                                <input class="text-only required" type="text" id="acc-lastname"
                                    value="<?=$ViewUserLastNameStr ?>" placeholder="Last Name" autocomplete="off">
                                <div class="acc-lastname-error" id="acc-lastname-error">
                                    <span>Looks good!</span>
                                </div>
                            </div>
                        </div>
                        <div class="acc-username">
                            <span>Username:</span>
                            <div class="acc-change-item">
                                <input class="char-first required" type="text" id="acc-username"
                                    value="<?=$ViewUsernameStr ?>" placeholder="Username" autocomplete="off">
                                <div class="acc-username-error" id="acc-username-error">
                                    <span>Looks good!</span>
                                </div>
                            </div>
                        </div>
                        <div class="acc-password">
                            <span>Password:</span>
                            <div class="acc-change-item">
                                <input class="required" type="password" id="acc-password" placeholder="Password"
                                    autocomplete="off">
                                <div class="acc-password-error" id="acc-password-error">
                                    <span>Looks good!</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="acc-btn">
                    <div></div>
                    <button>Confirm changes</button>
                </div>
            </form>
            <div style="height: 4px;"></div>
            <form class="acc-pass-change" action="handlers/handle_userpass.php" method="post">
                <div class="acc-old-password">
                    <span>Old password:</span>
                    <div class="acc-change-item">
                        <input class="required" type="password" id="acc-oldpassword-ch" placeholder="Password"
                            autocomplete="off">
                        <div class="acc-password-error" id="acc-oldpassword-error">
                            <span>Looks good!</span>
                        </div>
                    </div>
                </div>
                <div class="acc-new-password">
                    <span>New password:</span>
                    <div class="acc-change-item">
                        <input class="required" type="password" id="acc-newpassword-ch" placeholder="Password"
                            autocomplete="off">
                        <div class="acc-password-error" id="acc-newpassword-error">
                            <span>Looks good!</span>
                        </div>
                    </div>
                </div>
                <div class="acc-btn">
                    <button>Update password</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require('partials/footer.html.php') ?>