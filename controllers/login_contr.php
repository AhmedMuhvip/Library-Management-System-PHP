<?php

require_once '../Database.php';
require_once '../Validator.php';
require_once '../Model/login_model.php';
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $email    = Validator::clean_string($_GET['email']);
    $password = $_GET['password'];
    $errors   = [];
    if (Validator::input_empty_login($email, $password)) {
        $errors["empty_inputs"] = "Please fill in all fields.";
    }

    if ( ! Validator::email_registered($email)) {
        $errors['email_not_registered'] = "That Email not found. SignUp please";
    }
    $result = "";
    $ll     = new login_model();
    if (empty($errors) && $ll->check_data($email, $password)) {
        session_start();
        $username             = $ll->get_username($email);
        $_SESSION['username'] = $username['fname'];
        header("Location: ../views/sucess.php"); // No space around the colon
        exit();
    } else {
        $errors['Email Or Password Is Worng'] = "Email Or Password Is Worng";
    }

    if ( ! $result || ! password_verify($password, $result['password'])) {
        session_start();
        $_SESSION['errors']    = $errors;
        $_SESSION['form_data'] = $_POST; // Save form data to repopulate fields
        header("Location: ../views/login_view.php");
        exit();
    }
    if ( ! empty($errors)) {
        session_start();
        $_SESSION['errors']    = $errors;
        $_SESSION['form_data'] = $_POST; // Save form data to repopulate fields
        header("Location: ../views/login_view.php");
        exit();
    }
}