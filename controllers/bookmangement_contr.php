<?php

require_once __DIR__.'/../Database.php';
require_once __DIR__.'/../Validator.php';
require_once __DIR__.'/../Model/bookmangement_model.php';

// Get the current page from the query string or default to 1
$page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT) ?: 1;

// Initialize database connection
$ls = new bookmangement_model();

// Count total records in the books table
$count = $ls->count_book();

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
$rows = $ls->get_pg_data($pageLimit, $offset);
// Fetch books for the current page


