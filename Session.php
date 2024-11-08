<?php


session_start();

// Retrieve errors and form data from session, if they exist
$errors   = $_SESSION['errors'] ?? [];
$formData = $_SESSION['form_data'] ?? [];
$username = $_SESSION['username'] ?? [];
// Clear session data after displaying
unset($_SESSION['errors'], $_SESSION['form_data']);
