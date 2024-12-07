<?php

require __DIR__.'/../session.php';
if ( ! isset($_SESSION['logged'])) {
    header('Location: /');
    exit;
}
require_once __DIR__.'/../controllers/dashboard_cont.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Log In</title>
    <script async src="../script/login_script.js"></script>
</head>
<body class="bg-gray-900 text-gray-300 p-6">

<nav class="flex px-4 py-2 mb-4" aria-label="Breadcrumb">
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
                <a href="/dashboard"
                   class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">User
                    Managements</a>
            </div>
        </li>
    </ol>
</nav>

<section class="container px-4 mx-auto">
    <div class="flex items-center gap-x-3">
        <h2 class="text-lg font-medium text-gray-800 dark:text-white">Team members</h2>

        <span class="px-3 py-1 text-xs text-blue-600 bg-blue-100 rounded-full dark:bg-gray-800 dark:text-blue-400"><?= $count ?> users</span>
    </div>

    <div class="flex flex-col mt-6">
        <div class="overflow-x-auto">
            <div class="inline-block min-w-full py-2 align-middle">
                <div class="overflow-hidden border border-gray-200 dark:border-gray-700 rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-center">
                        <thead class="bg-gray-50 dark:bg-gray-800">
                        <tr>
                            <th scope="col" class="py-3.5 px-4 text-sm font-normal text-gray-500 dark:text-gray-400">
                                <span>Name</span>
                            </th>
                            <th scope="col" class="px-4 py-3.5 text-sm font-normal text-gray-500 dark:text-gray-400">
                                <button class="flex items-center justify-center gap-x-2">
                                    <span>Role</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z"/>
                                    </svg>
                                </button>
                            </th>
                            <th scope="col" class="px-4 py-3.5 text-sm font-normal text-gray-500 dark:text-gray-400">
                                Email Address
                            </th>
                            <th scope="col" class="px-4 py-3.5 text-sm font-normal text-gray-500 dark:text-gray-400">
                                Teams
                            </th>
                            <th scope="col" class="py-3.5 px-4">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                        <?php
                        if (isset($data)): ?>
                            <?php
                            foreach ($data as $item): ?>
                                <tr class="text-center">
                                    <!-- Name Column -->
                                    <td class="px-4 py-4 text-sm font-medium text-gray-700 dark:text-gray-300">
                                        <div class="flex items-center justify-center gap-x-3">
                                            <img class="object-cover w-10 h-10 rounded-full"
                                                 src="/p_images/<?= $item['image_name'] ?>"
                                                 alt="">
                                            <div>
                                                <h2 class="font-medium text-gray-800 dark:text-white">
                                                    <?= $item['fname'].' '.$item['lname'] ?>
                                                </h2>
                                                <p class="text-sm font-normal text-gray-600 dark:text-gray-400">
                                                    <?= $item['username'] ?>
                                                </p>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Role Column -->
                                    <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300">
                                        <?= $item['role'] ?>
                                    </td>

                                    <!-- Email Column -->
                                    <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300">
                                        <?= $item['email'] ?>
                                    </td>

                                    <!-- Teams Column -->
                                    <td class="px-4 py-4 text-sm">
                                        <a href="/borrowshistory?id=<?= $item['user_id'] ?>"
                                           class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800">Borrows
                                            History</a>
                                    </td>

                                    <!-- Actions Column -->
                                    <td class="px-4 py-4 text-sm">
                                        <div class="flex justify-center gap-x-6">
                                            <!-- Delete Button -->
                                            <button
                                                    class="text-gray-500 transition-colors duration-200 dark:hover:text-red-500 dark:text-gray-300 hover:text-red-500 focus:outline-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            endforeach; ?>
                        <?php
                        endif; ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="flex items-end justify-center mt-6">
        <?php
        if ($page > 1): ?>
            <a href="/dashboard?page= <?= $page - 1 ?>"
               class="flex items-center px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md gap-x-2 hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800">
            <span>
                Prev
            </span>

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-5 h-5 rtl:-scale-x-100">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"/>
                </svg>
            </a>
        <?php
        endif; ?>

        <!--        <div class="items-center hidden lg:flex gap-x-3">-->
        <!--            <a href="#" class="px-2 py-1 text-sm text-blue-500 rounded-md dark:bg-gray-800 bg-blue-100/60">1</a>-->
        <!--            <a href="#"-->
        <!--               class="px-2 py-1 text-sm text-gray-500 rounded-md dark:hover:bg-gray-800 dark:text-gray-300 hover:bg-gray-100">2</a>-->
        <!--            <a href="#"-->
        <!--               class="px-2 py-1 text-sm text-gray-500 rounded-md dark:hover:bg-gray-800 dark:text-gray-300 hover:bg-gray-100">3</a>-->
        <!--            <a href="#"-->
        <!--               class="px-2 py-1 text-sm text-gray-500 rounded-md dark:hover:bg-gray-800 dark:text-gray-300 hover:bg-gray-100">...</a>-->
        <!--            <a href="#"-->
        <!--               class="px-2 py-1 text-sm text-gray-500 rounded-md dark:hover:bg-gray-800 dark:text-gray-300 hover:bg-gray-100">12</a>-->
        <!--            <a href="#"-->
        <!--               class="px-2 py-1 text-sm text-gray-500 rounded-md dark:hover:bg-gray-800 dark:text-gray-300 hover:bg-gray-100">13</a>-->
        <!--            <a href="#"-->
        <!--               class="px-2 py-1 text-sm text-gray-500 rounded-md dark:hover:bg-gray-800 dark:text-gray-300 hover:bg-gray-100">14</a>-->
        <!--        </div>-->
        <?php
        if ($page >= 1 && $page != $pagesNum): ?>
            <a href="/dashboard?page= <?= $page + 1 ?>"
               class="flex items-center px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md gap-x-2 hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800">
            <span>
                Next
            </span>

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-5 h-5 rtl:-scale-x-100">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"/>
                </svg>
            </a>
        <?php
        endif; ?>
    </div>
</section>
</body>
</html>