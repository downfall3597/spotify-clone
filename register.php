<?php
include("includes/config.php");
include("includes/class/account.php");
include("includes/class/constants.php");
$account = new Account($con);
include("includes/handlers/register_handler.php");
include("includes/handlers/login_handler.php");
function getInputValue($name)
{
    if (isset($_POST[$name])) {
        echo $_POST[$name];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register form</title>
    <link rel="stylesheet" type="text/css" href="assets/css/register.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:200&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="assets/js/register.js"></script>
</head>

<body>
    <?php
    if (isset($_POST['registerButton'])) {
        echo '<script>
        $(document).ready(function() {
            $("#loginForm").hide();
            $("#registerForm").show();
        });
    </script>';
    } else {
        echo '<script>
        $(document).ready(function() {
            $("#loginForm").show();
            $("#registerForm").hide();
        });
    </script>';
    } ?>
    <div id="background">
        <div id="loginContainer">


            <div id="inputContainer">
                <form id="loginForm" action="register.php" method="POST">
                    <h2>Login to your account</h2>
                    <p>
                        <?php echo $account->getError(Constants::$loginFailed) ?>

                        <label for="loginUsername">Username</label>
                        <input type="text" id="loginUsername" placeholder="eg downfall24" name="loginUsername" value="<?php getInputValue('loginUsername') ?>" required>
                    </p>
                    <p>
                        <label for="loginPassword">Password</label>
                        <input type="password" id="loginPassword" name="loginPassword" required>
                    </p>
                    <button type="submit" name="loginButton">LOG IN</button>
                    <div class="hasAccountText">
                        <span id="hideLogin">Don't have an account yet? Signup here.</span>
                    </div>
                </form>
                <form id="registerForm" action="register.php" method="POST">
                    <h2>Join Spotify Now</h2>
                    <p>
                        <?php echo $account->getError(Constants::$usernameCharacters) ?>
                        <?php echo $account->getError(Constants::$duplicateUsername) ?>
                        <label for="username">Username</label>
                        <input type="text" id="username" placeholder="eg downfall24" name="username" value="<?php getInputValue('username') ?>" required>
                    </p>
                    <p>
                        <?php echo $account->getError(Constants::$firstNameCharacters) ?>
                        <label for="firstname">Firstname</label>
                        <input type="text" id="firstname" placeholder="eg Raju" name="firstname" value="<?php getInputValue('firstname') ?>" required>
                    </p>
                    <p>
                        <?php echo $account->getError(Constants::$lastNameCharacters) ?>
                        <label for="lastname">Lastname</label>
                        <input type="text" id="lastname" placeholder="eg Ambani" name="lastname" value="<?php getInputValue('lastname') ?>" required>
                    </p>
                    <p>
                        <?php echo $account->getError(Constants::$emailInvalid) ?>
                        <?php echo $account->getError(Constants::$duplicateEmail) ?>
                        <label for="email">Email Address</label>
                        <input type="email" id="email" placeholder="eg rajuambani24@gmail.com" name="email" value="<?php getInputValue('email') ?>" required>
                    </p>
                    <p>
                        <?php echo $account->getError(Constants::$passwordCharacters) ?>
                        <?php echo $account->getError(Constants::$passwordNotAlphanumeric) ?>
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                    </p>
                    <p>
                        <?php echo $account->getError(Constants::$passwordsDoNoMatch) ?>
                        <label for="password2">Confirm Password</label>
                        <input type="password" id="password2" name="password2" required>
                    </p>
                    <button type="submit" name="registerButton">SIGN UP</button>
                    <div class="hasAccountText">
                        <span id="hideRegister">Already have an account? Log in here.</span>
                    </div>
                </form>
            </div>
            <div id="loginText">
                <h1>Get great music, right now</h1>
                <h2>Listen to loads of songs for free</h2>
                <ul>
                    <li>Discover music you'll fall in love with</li>
                    <li>Create your own playlists</li>
                    <li>Follow artists to keep up to date</li>
                </ul>
            </div>
        </div>
    </div>

</body>

</html>