<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="assets/js/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/css/login.css">
    <title>Login</title>
</head>

<body>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <p class="close">&times;</p>
                <h1>Welcome!</h1>
            </div>
            <span>Congratulations! You've successfully signed up for BLOG.</span>
            <span>Now, just log in using the credentials you provided during registration.</span>
        </div>
    </div>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form class="form-signup" action="handlers/handle_registration.php" method="post">
                <h1 class="form-header">Create Account</h1>
                <div class="signup-item">
                    <input class="text-only required" type="text" id="signup-firstname" placeholder="First Name">
                    <div class="msg-error" id="signup-firstname-error">
                        Looks good!
                    </div>
                </div>
                <div class="signup-item">
                    <input class="text-only required" type="text" id="signup-lastname" placeholder="Last Name">
                    <div class="msg-error" id="signup-lastname-error">
                        Looks good!
                    </div>
                </div>
                <div class="signup-item">
                    <input class="required" type="text" id="signup-email" placeholder="Email">
                    <div class="msg-error" id="signup-email-error">
                        Looks good!
                    </div>
                </div>
                <div class="signup-item">
                    <input class="char-first required" type="text" id="signup-username" placeholder="Username">
                    <div class="msg-error" id="signup-username-error">
                        Looks good!
                    </div>
                </div>
                <div class="signup-item">
                    <input class="required" type="password" id="signup-password" placeholder="Password">
                    <div class="msg-error" id="signup-password-error">
                        Looks good!
                    </div>
                </div>
                <div class="signup-btn">
                    <button>Sign Up</button>
                </div>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form class="form-signin" action="handlers/handle_authentication.php" method="post">
                <h1 class="form-header">Sign in</h1>
                <div class="login-item">
                    <input class="required" type="text" id="login-email" placeholder="Email">
                    <div class="msg-error" id="login-email-error">
                        Looks good!
                    </div>
                </div>
                <div class="login-item">
                    <input class="required" type="password" id="login-password" placeholder="Password">
                    <div class="msg-error" id="login-password-error">
                        Looks good!
                    </div>
                </div>
                <button>Sign In</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>Please login with your personal info</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello!</h1>
                    <p>Enter your personal details and start</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/login.js"></script>
</body>

</html>