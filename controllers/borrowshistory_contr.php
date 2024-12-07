<?php

require_once __DIR__.'/../Database.php';
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $db_conn = new Database();

    $get_borrows_history        = $db_conn->db->query("SELECT *
FROM ((borrows
INNER JOIN books ON borrows.book_id = books.book_id)) where borrows.user_id={$user_id}");
    $get_borrows_history_result = $get_borrows_history->fetchAll(PDO::FETCH_ASSOC);
//    var_dump($get_borrows_history_result);
}