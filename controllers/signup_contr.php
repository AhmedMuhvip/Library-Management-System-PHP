<?php
require_once '../Database.php';
require_once '../Validator.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fname    = Validator::string($_POST['fname']);
    $lname    = Validator::string($_POST['lname']);
    $email    = Validator::string($_POST['email']);
    $password = Validator::string($_POST['password']);

    // Validate inputs
    if (Validator::input_empty($fname, $lname, $email, $password)) {
        $errors["empty_inputs"] = "Please fill in all fields.";
    }

    if (Validator::is_email_invalid($email)) {
        $errors["invalid_email"] = "Please enter a valid email address.";
    }
    if(Validator::email_registered($email)){
        $errors['email_is_registered']="That username is taken. Try another.";
    }
    if (empty($errors)) {
        $dn = new Database();

        $result = $dn->create($fname, $lname, $email, $password);

        if ($result) {
            // If successful, redirect to a success page or login
            header("Location: ../views/login_view.php");
            exit();
        }

    }

    // If there are errors, redirect back to the form
    if (!empty($errors)) {
        // Pass errors back to the signup page
        session_start();
        $_SESSION['errors'] = $errors;
        $_SESSION['form_data'] = $_POST; // Save form data to repopulate fields
        header("Location: ../views/signup_view.php");
        exit();
    }
}
