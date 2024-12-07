<?php

require_once __DIR__.'/../Database.php';
$db_instance = new Database();
$user_id     = $_SESSION['id'];
if (isset($_GET['borrow_id'])) {
    $borrow_id   = $_GET['borrow_id'];
    $returned    = 'returned';
    $borrow_stmt = $db_instance->db->query("
    UPDATE books
    JOIN borrows
        ON books.book_id = borrows.book_id
    SET books.availability = 1,
        borrows.status = 'returned',
        borrows.return_date = '".date('Y-m-d')."'
    WHERE borrows.borrow_id = {$borrow_id}
");

}
$stmt   = $db_instance->db->query("SELECT book_name,borrow_id,borrow_date,due_date
FROM ((borrows
INNER JOIN books ON borrows.book_id = books.book_id))where user_id=$user_id and status=\"borrowed\"");
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

//var_dump($result);
