<?php

require_once __DIR__.'/../Model/viewbooks.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Dark Themed Table</title>
</head>
<body class="bg-gray-900 text-gray-300 p-6">
<div class="max-w-4xl mx-auto bg-gray-800 shadow-lg rounded-lg">
    <!-- Card Header -->
    <div class="flex justify-between items-center border-b border-gray-700 p-5">
        <h3 class="text-xl font-semibold text-gray-200">Books</h3>
        <label class="flex items-center space-x-2 text-gray-400">
            <a href="/createbook" name="" role="button"
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
                <th class="w-16 px-4 py-2 text-gray-300"></th>
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
                            echo $row['author']; ?></td>
                        <td class="px-4 py-2 text-gray-300 text-center"><?php
                            echo $row['book_name']; ?></td>
                        <td class="px-4 py-2 text-gray-300 text-center"><?= $row['category'] ?> </td>
                        <td class="px-4 py-2 text-center">
                            <?= $row['published_at'] ?>
                        </td>
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
            <span>Show</span>
            <label>
                <select class="form-select w-16 p-1 bg-gray-700 border border-gray-600 text-gray-300 rounded"
                        name="peerage">
                    <option name="first" value="five" selected>

                        5
                    </option>
                    <option name="last" value="ten">10</option>
                    <option>20</option>
                </select>

            </label>
            <span>per page</span>
        </div>
        <div class="flex items-center gap-4 mt-4 md:mt-0">
            <?php
            if (isset($pages)): ?>
            <span>Showing 1 to <?= $pages ?> of
                <?php
                echo $pages;
                endif;
                ?> entries</span>
            <div class="flex space-x-2">
                <?php
                if (isset($_GET['page-nr']) && $_GET['page-nr'] > 1) {
                    ?>
                    <a class="px-2 py-1 border rounded bg-gray-700 text-gray-300 hover:bg-gray-600" href="?page-nr=<?php
                    echo $_GET['page-nr'] - 1 ?>">Prev</a>
                    <?php
                } else {
                    ?>
                    <a class="px-2 py-1 border rounded bg-gray-700 text-gray-300 hover:bg-gray-600">Prev</a>
                    <?php
                }
                ?>
                <?php
                if ( ! isset($_GET['page-nr'])) {
                    ?>
                    <a class="px-2 py-1 border rounded bg-gray-700 text-gray-300 hover:bg-gray-600" href="?page-nr=2">Next</a>
                    <?php
                } else {
                    if ($_GET['page-nr'] >= $pages) {
                        ?>

                        <?php
                    } else {
                        ?>
                        <a class="px-2 py-1 border rounded bg-gray-700 text-gray-300 hover:bg-gray-600"
                           href="?page-nr=<?php
                           echo $_GET['page-nr'] + 1 ?>">Next</a>

                        <?php

                    }
                } ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
