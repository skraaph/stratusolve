<?php //unset($_SESSION['post']['start_post_id']); ?>
<?php require('partials/head.html.php') ?>

<!-- Main -->
<div class="main">
    <div class="main-header">
        <span>Account</span>
    </div>
    <form action="handlers/handle_userchange.php" method="post" class="acc-change">
        <div class="acc-firstname">
            <span>First Name:</span>
            <input class="text-only" type="text" id="acc-firstname" placeholder="First Name" autocomplete="off"
                required>
            <div class="acc-firstname-error" id="acc-firstname-error">
                Looks good!
            </div>
        </div>
        <div class="acc-lastname">
            <span>Last Name:</span>
            <input class="text-only" type="text" id="acc-lastname" placeholder="Last Name" autocomplete="off" required>
            <div class="acc-lastname-error" id="acc-lastname-error">
                Looks good!
            </div>
        </div>
        <div class="acc-username">
            <span>Username:</span>
            <input class="char-first" type="text" id="acc-username" placeholder="Username" autocomplete="off" required>
            <div class="acc-username-error" id="acc-username-error">
                Looks good!
            </div>
        </div>
        <div class="acc-password">
            <span>Password:</span>
            <input type="password" id="acc-password" placeholder="Password" autocomplete="off" required>
            <div class="acc-password-error" id="acc-password-error">
                Looks good!
            </div>
        </div>
        <div class="acc-btn">
            <div></div>
            <button>Confirm changes</button>
            <div class="acc-btn-done">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                    <path
                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                </svg>
            </div>
        </div>
    </form>
</div>

<?php require('partials/footer.html.php') ?>