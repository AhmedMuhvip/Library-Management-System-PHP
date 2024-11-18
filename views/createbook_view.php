<?php

require_once __DIR__."/../session.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet"/>
    <title>Create 1Book</title>
</head>
<body>
<section class="bg-white dark:bg-gray-900 h-screen">
    <div class="max-w-2xl px-4 py-8 mx-auto lg:py-16">
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Add Book</h2>
        <form action="/addbook" method="GET">
            <?php
            if (isset($errors['empty_inputs'])): ?>
                <div class="p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300"
                     role="alert">
                    <span class="font-medium">Warning alert!</span> All Fields is Required.
                </div>
            <?php
            endif;
            ?>
            <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                <div class="sm:col-span-2">
                    <label for="book_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Book
                        Name</label>
                    <input type="text" name="book_name" id="book_name"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                           value="" placeholder="Type Book name">
                </div>
                <div class="w-full">
                    <label for="author"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Author</label>
                    <input type="text" name="author" id="author"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                           value="" placeholder="Author Name">
                </div>
                <div class="w-full">
                    <label for="published_at"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Published At</label>
                    <input type="date" name="published_at" id="published_at"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                           value="" placeholder="$299">
                </div>
                <div>
                    <label for="category"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                    <select id="category" name="category"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        <option name="action" selected="" value="Action">Action</option>
                        <option name="drama" value="Drama">Drama</option>
                        <option name="sf" value="Science fiction">Science fiction</option>
                        <option name="horror" value="Horror">Horror</option>
                        <option name="lf" value="Literary fiction">Literary fiction</option>
                    </select>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    Add Book
                </button>
                <!--                <button type="button"-->
                <!--                        class="text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">-->
                <!--                    <svg class="w-5 h-5 mr-1 -ml-1" fill="currentColor" viewBox="0 0 20 20"-->
                <!--                         xmlns="http://www.w3.org/2000/svg">-->
                <!--                        <path fill-rule="evenodd"-->
                <!--                              d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"-->
                <!--                              clip-rule="evenodd"></path>-->
                <!--                    </svg>-->
                <!--                    Delete-->
                <!--                </button>-->
            </div>
        </form>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>
</html>