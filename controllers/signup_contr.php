<?php

require_once __DIR__.'/../Database.php';
require_once __DIR__.'/../Validator.php';
require_once __DIR__.'/../Model/signup_model.php';

$errors = [];
echo "hi";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fname    = Validator::clean_string($_POST['fname']);
    $lname    = Validator::clean_string($_POST['lname']);
    $email    = Validator::clean_string($_POST['email']);
    $password = Validator::clean_string($_POST['password']);
    $image    = $_FILES['image'];

    // Validate inputs first
    if (Validator::input_empty($fname, $lname, $email, $password)) {
        $errors["empty_inputs"] = "Please fill all fields.";
    }

    if (Validator::is_email_invalid($email)) {
        $errors["invalid_email"] = "Please enter a valid email address.";
    }
    if (Validator::email_registered($email)) {
        $errors['email_is_registered'] = "That email is taken. Try another.";
    }
    if (Validator::password_invalid($password)) {
        $errors['invalid_password'] = "Please Enter Valid Password Should Be More Than 8 Chars And Less than 15";
    }

    // Validate image only if there are no input errors
    if (empty($errors)) {
        if (isset($image) && $image['error'] === 0) {
            $image_name       = $image['name'];
            $image_tmp_name   = $image['tmp_name'];
            $image_size       = $image['size'];
            $image_ext        = explode('.', $image_name);
            $image_actual_ext = strtolower(end($image_ext));
            $allowed_type     = ['jpg', 'jpeg', 'png'];

            // Validate image
            if (in_array($image_actual_ext, $allowed_type) && $image_size < 500000) {
                $image_new_name = uniqid('', true).".".$image_actual_ext;
                $image_dest     = __DIR__.'/../p_images/'.$image_new_name;
                move_uploaded_file($image_tmp_name, $image_dest);
            } else {
                $errors['invalid_image'] = "Invalid image format or size.";
            }
        } else {
            $errors['image_error'] = "Image upload error.";
        }
    }

    // Proceed if there are no errors
    if (empty($errors)) {
        $dd     = new signup_model();
        $result = $dd->createUser($fname, $lname, $email, $password, $image_new_name ?? null);

        if ($result) {
            session_start();
            $_SESSION['signup_success'] = "Signup successful! Redirecting to login page...";
            header("Location: /");
            exit();
        }
    }

    // If there are errors, redirect back to the form
    if ( ! empty($errors)) {
        session_start();
        $_SESSION['errors']    = $errors;
        $_SESSION['form_data'] = $_POST; // Save form data to repopulate fields
        header("Location: /signup");
        exit();
    }
}