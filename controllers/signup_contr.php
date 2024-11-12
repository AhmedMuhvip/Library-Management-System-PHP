<?php


require_once '../Database.php';
require_once '../Validator.php';
require_once '../Model/signup_model.php';


$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fname    = Validator::clean_string($_POST['fname']);
    $lname    = Validator::clean_string($_POST['lname']);
    $email    = Validator::clean_string($_POST['email']);
    $password = Validator::clean_string($_POST['password']);


    // Validate inputs
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
        $errors['invalid_password'] = "Please Enter Valid Password Should Be More Than 8 Chars And Les than 15";
    }
    if (empty($errors)) {
        $dd     = new signup_model();
        $result = $dd->createUser($fname, $lname, $email, $password);

        if ($result) {
            session_start();
            $_SESSION['signup_success'] = "Signup successful! Redirecting to login page...";
            header("Location: /");
            exit();
        }

    }

    // If there are errors, redirect back to the form
    if ( ! empty($errors)) {
        // Pass errors back to the signup page
        session_start();
        $_SESSION['errors']    = $errors;
        $_SESSION['form_data'] = $_POST; // Save form data to repopulate fields
        header("Location: /signup");
        exit();
    }
}
