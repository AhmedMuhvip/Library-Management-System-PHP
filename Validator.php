<?php


require_once __DIR__.'/Database.php';
require_once __DIR__.'/Model/signup_model.php';

class Validator
{


    // Validate a string input, returning sanitized string or false if invalid
    public static function input_empty(...$inputs)
    {
        foreach ($inputs as $input) {
            if (empty($input)) {
                return true; // If any input is empty, return true
            }
        }

        return false; // If none of the inputs are empty, return false
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

    public static function clean_string($value)
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

    public static function password_invalid($paswword, $min = 8, $max = 15)
    {
        return strlen($paswword) > $max || strlen($paswword) < $min;
    }


//    public static function Valdiate_image($image_actual_ext,$allowed_type,$image_size,$image_tmp_name){
//        if (in_array($image_actual_ext, $allowed_type) && $image_size < 500000) {
//            $image_new_name = uniqid('', true).".".$image_actual_ext;
//            $image_dest     = __DIR__.'/../p_images/'.$image_new_name;
//            move_uploaded_file($image_tmp_name, $image_dest);
//        }else{
//            echo "<div>Error</div>"
//        }
//    }
}


