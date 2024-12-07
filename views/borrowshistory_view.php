<?php

require_once __DIR__.'/../session.php';
require_once __DIR__.'/../controllers/borrowshistory_contr.php';
if ( ! isset($_SESSION['logged'])) {
    header('Location: /');
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Borrow History</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes fade-in {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.6s ease-out;
        }
    </style>
</head>
<body class="bg-gray-900 text-gray-300 min-h-screen flex justify-center p-6">
<div class="w-full max-w-5xl mt-10">
    <nav class="flex mb-5" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="/home"
                   class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                    <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                         fill="currentColor"
                         viewBox="0 0 20 20">
                        <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                    </svg>
                    Home
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 9 4-4-4-4"/>
                    </svg>
                    <a href="/dashboard"
                       class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">User
                        Management</a>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 9 4-4-4-4"/>
                    </svg>
                    <a href="/borrowshistory"
                       class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Borrows
                        History</a>
                </div>
            </li>
        </ol>
    </nav>
    <div class="overflow-x-auto rounded-lg shadow-2xl bg-gray-800 animate-fade-in">
        <table class="table-auto w-full text-sm text-left text-gray-300">
            <thead class="text-sm uppercase bg-gray-700 text-gray-400">
            <tr>
                <th class="px-6 py-4">#</th>
                <th class="px-6 py-4">Book Name</th>
                <th class="px-6 py-4">Borrows Date</th>
                <th class="px-6 py-4">Return Date</th>
                <th class="px-6 py-4">Favorite Color</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (isset($get_borrows_history_result)):
            foreach ($get_borrows_history_result

            as $value):
            ?>
            <tr class="border-b border-gray-700 hover:bg-gray-600 transition-colors duration-200">
                <th class="px-6 py-4">1</th>
                <td class="px-6 py-4 font-medium text-white"><?= $value['book_name'] ?></td>
                <td class="px-6 py-4"><?= date('d-m-Y', strtotime($value['borrow_date'])) ?></td>
                <td class="px-6 py-4"><?php
                    if ( ! empty($value['return_date'])) {
                        echo date('d-m-Y', strtotime($value['return_date']));
                    } else {
                        echo '';
                    }
                    ?></td>
                <td class="px-6 py-4">
                    <span class="inline-block w-5 h-5 rounded-full bg-blue-500 mr-2"></span>
                    <?= $value['status'] ?>
                </td>
                <?php
                endforeach;
                endif ?>
            </tr>
            <!-- Repeat similar rows dynamically -->
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
