<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $email    = Validator::string($_POST['email']);
    $password = Validator::string($_POST['password']);
}