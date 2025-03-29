<!DOCTYPE html>
<html lang="en">
<head>
    <!-- all meta data -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Login successful page">
    <meta name="robots" content="noindex, nofollow">
    <meta name="author" content="Kai Thompson">
    <title>Success!</title>
    <!-- link to the css file -->
    <link rel="stylesheet" href="./css/styles.css">
    <!-- link to font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
<!-- add the header -->
<?php
include './templates/header.php';
?>
<main>
    <!-- php logic to ensure the user is logged in -->
<?php
    // get the session
    // checks is a session is already started, (stems from header starting sessions to add extra links)
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    // check if the user is logged in, if not redirect to the login page
    if (!isset($_SESSION['username'])) {
        header("Location: ./SignIn.php");
        exit();
    }
    // welcome if the user is logged in
    echo "<h2>Welcome " . $_SESSION['username'] . "!</h2>";
        
?>    
</main>
<!-- add the footer -->
<?php
include './templates/footer.php';
?>
</body>
</html>