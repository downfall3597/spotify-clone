<?php
if (isset($_POST["loginButton"])) {
    $loginUsername = $_POST["loginUsername"];
    $loginPassword = $_POST["loginPassword"];
    $r = $account->login($loginUsername, $loginPassword);
    if ($r == true) {
        $_SESSION["userLoggedIn"] = $loginUsername;
        header("Location:index.php");
    }
}
