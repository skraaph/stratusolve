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
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form class="form-signup" action="handlers/handle_registration.php" method="post">
                <h1 class="form-header">Create Account</h1>
                <div class="signup-item">
                    <input class="text-only" type="text" id="signup-firstname" placeholder="First Name" required>
                    <div class="signup-firstname-error" id="signup-firstname-error">
                        Looks good!
                    </div>
                </div>
                <div class="signup-item">
                    <input class="text-only" type="text" id="signup-lastname" placeholder="Last Name" required>
                    <div class="signup-lastname-error" id="signup-lastname-error">
                        Looks good!
                    </div>
                </div>
                <div class="signup-item">
                    <input type="email" id="signup-email" placeholder="Email" required>
                    <div class="signup-email-error" id="signup-email-error">
                        Looks good!
                    </div>
                </div>
                <div class="signup-item">
                    <input class="char-first" type="text" id="signup-username" placeholder="Username" required>
                    <div class="signup-username-error" id="signup-username-error">
                        Looks good!
                    </div>
                </div>
                <div class="signup-item">
                    <input type="password" id="signup-password" placeholder="Password" required>
                    <div class="signup-password-error" id="signup-password-error">
                        Looks good!
                    </div>
                </div>
                <div class="signup-btn">
                    <div></div>
                    <button>Sign Up</button>
                    <div class="signup-btn-done">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                            <path
                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                        </svg>
                    </div>
                </div>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form class="form-signin" action="handlers/handle_authentication.php" method="post">
                <h1 class="form-header">Sign in</h1>
                <div class="login-item">
                    <input type="email" id="login-email" placeholder="Email" required>
                    <div class="login-email-error">
                        Looks good!
                    </div>
                </div>
                <div class="login-item">
                    <input type="password" id="login-password" placeholder="Password" required>
                    <div class="login-password-error">
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