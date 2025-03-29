<?php

class Validate {
    // function to check if the username is valid
    public static function isValidUsername($username) 
    {
        // check if the username is empty or less than 3 characters
        if (empty($username) || strlen($username) <= 3) {
            return false;
        }
        // check if the username contains only letters and numbers
        if (!preg_match('/^[a-zA-Z0-9]+$/', $username)) {
            return false;
        }
        return true;
    }

    // function to check if the password is valid
    public static function isValidPassword($password) 
    {
        // check if the password is empty or less than/ equal to 6 characters
        if (empty($password) || strlen($password) <= 6) {
            return false;
        }
        return true;
    }
}