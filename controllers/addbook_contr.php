<?php

require_once __DIR__.'/../Database.php';
require_once __DIR__.'/../Validator.php';
require_once __DIR__.'/../Model/createbook_model.php';

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $book_name    = Validator::clean_string($_GET['book_name']);
    $author       = Validator::clean_string($_GET['author']);
    $published_at = $_GET['published_at'];
    $category     = $_GET['category'];

    if (Validator::input_empty($book_name, $author, $published_at, $category)) {
        $errors["empty_inputs"] = "Please fill all fields.";
    }
    if (empty($errors)) {
        $book   = new createbook_model();
        $result = $book->createBook($book_name, $author, $published_at, $category);

        if ($result) {
            header("Location: /bookmangement");
        }
    }

    if ( ! empty($errors)) {
        session_start();
        $_SESSION['errors']    = $errors;
        $_SESSION['form_data'] = $_POST; // Save form data to repopulate fields
        header("Location: /createbook");
        exit();
    }
}
