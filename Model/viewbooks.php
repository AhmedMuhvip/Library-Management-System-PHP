<?php

require_once __DIR__.'/../Database.php';
require_once __DIR__.'/../Validator.php';

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

$ls        = new Database();
$records   = $ls->db->query('SELECT count(*) FROM books');
$count     = $records->fetchColumn();
$pageLimit = 5;
$pagesNum  = ceil($count / $pageLimit);
$offset    = ($page - 1) * $pageLimit;

function validatePage(int $page, int $pagesNum): bool
{
    return $page >= 1 and $page <= $pagesNum;
}

if ( ! validatePage($page, $pagesNum)) {
    exit();
}

$stmt = $ls->db->prepare("SELECT  * FROM books LIMIT {$pageLimit} OFFSET {$offset}");
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
