<?php

require_once __DIR__.'/../Database.php';
require_once __DIR__.'/../Validator.php';

// Get the current page from the query string or default to 1
$page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT) ?: 1;

// Initialize database connection
$ls = new Database();

// Count total records in the books table
$records = $ls->db->query('SELECT count(*) FROM books');
$count   = $records->fetchColumn();

// Pagination logic
$pageLimit = 5;
$pagesNum  = $count > 0 ? ceil($count / $pageLimit) : 1;
$offset    = ($page - 1) * $pageLimit;

// Validate page number
function validatePage(int $page, int $pagesNum): bool
{
    return $page >= 1 && $page <= $pagesNum;
}

if ( ! validatePage($page, $pagesNum)) {
    header("Location: /bookmanagement?page=1");
    exit();
}

// Fetch books for the current page
$stmt = $ls->db->prepare("SELECT * FROM books LIMIT :pageLimit OFFSET :offset");
$stmt->bindValue(':pageLimit', $pageLimit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

