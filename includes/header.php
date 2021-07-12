<?php
include("includes/config.php");
include("includes/class/Artist.php");
include("includes/class/Album.php");
include("includes/class/Song.php");
if (isset($_SESSION['userLoggedIn'])) {
    $userLoggedIn = $_SESSION['userLoggedIn'];
    echo "<script> userLoggedIn = '$userLoggedIn';</script>";
} else {
    header("Location: register.php");
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Lato|Montserrat&display=swap" rel="stylesheet">
    <script src="assets/js/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
    <title>spotify</title>
</head>

<body>
    <div id="mainContainer">
        <div id="topContainer">
            <?php include("includes/navbarContainer.php"); ?>
            <div id="mainViewContainer">

                <div id="mainContent">