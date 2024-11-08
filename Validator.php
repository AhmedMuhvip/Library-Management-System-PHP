<?php


require_once 'Database.php';
require_once '../Model/signup_model.php';

class Validator
{


    // Validate a string input, returning sanitized string or false if invalid
    public static function input_empty($fname, $lanme, $email, $password)
    {
        if (empty($fname) || empty($lanme) || empty($email) || empty($password)) {
            return true;
        } else {
            return false;
        }
    }


    public static function input_empty_login($email, $password)
    {
        if (empty($email) || empty($password)) {
            return true;
        } else {
            return false;
        }
    }


    public static function is_email_invalid(string $email)
    {
        if ( ! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }


    public static function string($value)
    {
        $value = trim($value);
        $value = stripslashes($value);

        $value = htmlspecialchars($value);

        return $value;

    }

    public static function email_registered($value)
    {
        $mty = new signup_model();

        if ( ! $mty->get_email($value)) {
            return false;
        }

        return true;
    }

}


