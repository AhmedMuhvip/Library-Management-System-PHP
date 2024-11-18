<?php

require_once __DIR__.'/../Database.php';
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id      = $_GET['id'];
    $dl_book = new Database();
    $dl_book->db->query("DELETE FROM books WHERE book_id={$id}");
}
header('Location: /bookmangement');
exit();