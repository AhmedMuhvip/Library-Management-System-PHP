<?php

require_once __DIR__.'/../Database.php';
require_once __DIR__.'/../Validator.php';

//$books_per_page = 5;
//$current_page   = 1;
//$current_books_list;
//
//if (isset($_GET['count'])) {
//    $ol = $_GET['peerage'];
//    echo $ol;
//    die();
//} elseif (isset($_GET['next'])) {
//    $ol = $_GET['peerage'];
//    echo $ol;
//    die();
//} elseif (isset($_GET['previous'])) {
//    $ol = $_GET['peerage'];
//    echo $ol;
//    die();
//}


$ls             = new Database();
$start          = 0;
$rows_per_pages = 7;

if (isset($_GET['page-nr'])) {
    $page  = $_GET['page-nr'] - 1;
    $start = $page * $rows_per_pages;
}
$records = $ls->db->query('SELECT count(*) FROM books');
$count   = $records->fetchColumn();
$pages   = ceil($count / $rows_per_pages);
$stmt    = $ls->db->prepare("SELECT * FROM books LIMIT {$start},{$rows_per_pages}");
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
