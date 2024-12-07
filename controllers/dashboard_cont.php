<?php

require_once __DIR__.'/../Database.php';
$page    = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT) ?: 1;
$db_conn = new Database();
$records = $db_conn->db->query('SELECT count(*) FROM users');
$count   = $records->fetchColumn();

$usersLimit = 5;
$pagesNum   = $count > 0 ? ceil($count / $usersLimit) : 1;
$offset     = ($page - 1) * $usersLimit;

function validatePage(int $page, int $pagesNum): bool
{
    return $page >= 1 && $page <= $pagesNum;
}

if ( ! validatePage($page, $pagesNum)) {
    header("Location: /dashboard?page=1");
    exit();
}
$db_query = $db_conn->db->query("SELECT * from users LIMIT {$usersLimit} offset {$offset}");
$data     = $db_query->fetchAll(PDO::FETCH_ASSOC);
//var_dump($data);
