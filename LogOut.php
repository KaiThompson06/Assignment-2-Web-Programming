<?php
// get the header
include './templates/header.php';
// get the current session
session_start();
// uset all session variables
session_unset();
// destroy the session
session_destroy();
// redirect to the login page
header("Location: ./SignIn.php");