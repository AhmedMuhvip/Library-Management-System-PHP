<?php

require __DIR__.'/../controllers/bookmangement_contr.php';
require __DIR__.'/../session.php';
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
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Books View</title>
</head>
<body class="bg-gray-900 text-gray-300 p-6">
<nav class="flex" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
        <li class="inline-flex items-center">
            <a href="/home"
               class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
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
                <a href="/bookmangement"
                   class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Books
                    Management</a>
            </div>
        </li>
    </ol>
</nav>

<div class="max-w-4xl mx-auto bg-gray-800 shadow-lg rounded-lg">
    <!-- Card Header -->
    <div class="flex justify-between items-center border-b border-gray-700 p-5">
        <h3 class="text-xl font-semibold text-gray-200">Books</h3>
        <label class="flex items-center space-x-2 text-gray-400">
            <a href="/createbook" role="button"
               class="bg-[#111827] hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                Create Book
            </a>
        </label>
    </div>

    <!-- Card Body with Table -->
    <div class="overflow-x-auto p-5">
        <table class="min-w-full border border-gray-700">
            <thead class="bg-gray-700">
            <tr>
                <th class="w-24 text-center px-4 py-2 font-semibold text-gray-300">Availability</th>
                <th class="px-4 py-2 font-semibold text-gray-300">Book Name</th>
                <th class="px-4 py-2 font-semibold text-gray-300">Author</th>
                <th class="px-4 py-2 font-semibold text-gray-300">Category</th>
                <th class="px-4 py-2 font-semibold text-gray-300">Published At</th>
                <th class="px-4 py-2 font-semibold text-gray-300">Book Quantity</th>
                <th class="px-4 py-2 font-semibold text-gray-300">Actions</th>

            </tr>
            </thead>
            <tbody class="bg-gray-800 divide-y divide-gray-700">
            <?php
            if (isset($rows)):
                foreach ($rows

                         as $row): ?>
                    <tr>
                        <td class="text-center px-4 py-2">
                            <?php
                            if ($row['availability'] === 1):
                                ?>
                                <span class="inline-block w-3 h-3 rounded-full bg-green-500"></span>
                            <?php
                            elseif ($row['availability'] === 0):
                                ?>
                                <span class="inline-block w-3 h-3 rounded-full bg-red-500"></span>
                            <?php
                            endif; ?>
                        </td>

                        <td class="px-4 py-2 text-gray-300 text-center"><?php
                            echo $row['book_name']; ?></td>
                        <td class="px-4 py-2 text-gray-300 text-center"><?php
                            echo $row['author']; ?></td>

                        <td class="px-4 py-2 text-gray-300 text-center"><?= $row['category'] ?> </td>
                        <td class="px-4 py-2 text-center">
                            <?= $row['published_at'] ?>
                        </td>
                        <td class="px-4 py-2 text-gray-300 text-center"><?= $row['book_quantity'] ?> </td>
                        <td class="px-4 py-2 text-center">
                            <form action="/delete" method="GET">

                                <a class="text-red-400 hover:text-red-500"
                                   href="/delete?id=<?= $row['book_id'] ?>">Delete</a>
                            </form>
                        </td>

                    </tr>
                <?php
                endforeach;
            endif; ?>
            <!-- Additional rows here... -->
            </tbody>
        </table>
    </div>

    <!-- Card Footer with Pagination -->
    <div class="flex flex-col md:flex-row items-center justify-between p-5 border-t border-gray-700 text-sm text-gray-400">
        <div class="flex items-center gap-2">

        </div>
        <div class="flex items-center gap-4 mt-4 md:mt-0">
            <?php
            if (isset($pagesNum, $page)): ?>
            <span>Showing <?php
                echo $page ?> of <?= $pagesNum ?>
                <?php
                endif;
                ?></span>
            <div class="flex items-center gap-4 mt-4 md:mt-0">
                <div class="flex space-x-2">
                    <?php
                    if ($page > 1): ?>
                        <a href="/bookmangement?page=<?= $page - 1 ?>"
                           class="px-2 py-1 border rounded bg-gray-700 text-gray-300 hover:bg-gray-600">Prev</a>
                    <?php
                    endif; ?>
                    <?php

                    if ($page >= 1 && $page != $pagesNum): ?>
                        <a class="px-2 py-1 border rounded bg-gray-700 text-gray-300 hover:bg-gray-600"
                           href="/bookmangement?page=<?= $page + 1 ?>">Next</a>
                    <?php
                    endif; ?>


                </div>
            </div>

        </div>

    </div>
</body>
</html>
