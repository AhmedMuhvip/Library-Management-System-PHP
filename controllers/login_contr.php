<?php

require_once __DIR__.'/../Database.php';
require_once __DIR__.'/../Validator.php';
require_once __DIR__.'/../Model/login_model.php';
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $email    = Validator::clean_string($_GET['email']);
    $password = $_GET['password'];
    $errors   = [];
    if (Validator::input_empty_login($email, $password)) {
        $errors["empty_inputs"] = "Please fill all fields.";
    }

    if ( ! Validator::email_registered($email)) {
        $errors['email_not_registered'] = "That Email not found. SignUp please";
    }
    $result = "";
    $ll     = new login_model();
    if (empty($errors) && $ll->check_data($email, $password)) {
        session_start();

        $data                 = $ll->get_data($email);
        $_SESSION['username'] = $data['fname'];
        $_SESSION['role']     = $data['role'];
        header("Location: /home"); // No space around the colon
        exit();
    } else {
        $errors['Email Or Password Is Wrong'] = "Email Or Password Is Wrong";
    }

    if ( ! $result || ! password_verify($password, $result['password'])) {
        session_start();
        $_SESSION['errors']    = $errors;
        $_SESSION['form_data'] = $_POST; // Save form data to repopulate fields
        header("Location: /");
        exit();
    }
    if ( ! empty($errors)) {
        session_start();
        $_SESSION['errors']    = $errors;
        $_SESSION['form_data'] = $_POST; // Save form data to repopulate fields
        header("Location: /");
        exit();
    }
}