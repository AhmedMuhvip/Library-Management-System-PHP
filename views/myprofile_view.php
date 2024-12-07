<?php

require __DIR__.'/../session.php';
if ( ! isset($_SESSION['logged'])) {
    header('Location: /');
    exit;
}
require_once __DIR__.'/../controllers/mypforile_contr.php';
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>My Profile</title>
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
                <a href="/me"
                   class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">My
                    Profile</a>
            </div>
        </li>
    </ol>
</nav>

<div class="min-h-screen bg-gray-900 py-10 px-5 text-white">
    <div class="max-w-6xl mx-auto bg-gray-800 p-8 rounded-xl shadow-lg">
        <!-- Profile Header with Avatar and Edit Button -->
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-6">
                <div class="relative">
                    <img src="/p_images/<?php
                    echo $img; ?>" alt="User Avatar"
                         class="w-24 h-24 rounded-full border-4 border-indigo-500">
                </div>
                <div>
                    <h1 class="text-4xl font-semibold text-white mb-3"><?php
                        echo $_SESSION['fname'].' '.$_SESSION['lname'] ?></h1>
                    <p class="text-lg text-gray-600">Software Engineer</p>
                </div>
            </div>
        </div>

        <!--         Navigation Tabs -->
        <!--        <div class="mt-8">-->
        <!--            <div class="flex space-x-8 border-b border-gray-700 pb-2">-->
        <!--                <button class="text-gray-300 text-lg py-2 px-4 hover:text-indigo-500">Book name</button>-->
        <!--                <button class="text-gray-300 text-lg py-2 px-4 hover:text-indigo-500">Borrow Date</button>-->
        <!--                <button class="text-gray-300 text-lg py-2 px-4 hover:text-indigo-500">Due Date</button>-->
        <!--                <button class="text-gray-300 text-lg py-2 px-4 hover:text-indigo-500">Action</button>-->
        <!--            </div>-->
        <!--        </div>-->

        <!-- Integrated Table Section -->
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-12 ">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mb-2">
                <thead class="text-xs text-gray-300 uppercase bg-gray-700 dark:bg-gray-800 dark:text-gray-400 text-center">
                <?php
                if ( ! empty($result)): ?>
                <tr>
                    <th scope="col" class="px-6 py-3">Book name</th>
                    <th scope="col" class="px-6 py-3">Borrow Date</th>
                    <th scope="col" class="px-6 py-3">Due Date</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($result as $item): ?>
                    <tr class="bg-gray-800 border-b dark:bg-gray-900 dark:border-gray-700 hover:bg-gray-700 dark:hover:bg-gray-700 text-center">
                        <th scope="row" class="px-6 py-4 font-medium text-white whitespace-nowrap dark:text-white">
                            <?= $item['book_name'] ?>
                        </th>
                        <td class="px-6 py-4"><?= date('d/m/Y', strtotime($item['borrow_date'])) ?></td>
                        <td class="<?php
                        echo (DateTime::createFromFormat('Y-m-d H:i:s',
                                        $item['due_date'])->format('Y-m-d') >= (new DateTime())->format('Y-m-d'))
                                ? 'text-green-500'
                                : 'text-red-600';
                        ?>">
                            <?php
                            echo DateTime::createFromFormat('Y-m-d H:i:s', $item['due_date'])->format('d/m/Y'); ?>
                        </td>


                        <td class="px-6 py-4">
                            <a href="/me?borrow_id=<?= $item['borrow_id'] ?>"
                               class="font-medium text-indigo-500 hover:underline">Return</a>
                        </td>
                    </tr>
                <?php
                endforeach;
                endif; ?>
                </tbody>
            </table>
        </div>
        <div class="mt-12">
            <h3 class="text-2xl font-medium text-white">Recent Activity</h3>
            <div class="mt-4 space-y-4">
                <div class="bg-gray-700 p-4 rounded-lg shadow-md">
                    <p class="text-gray-300">You completed the "Advanced Tailwind CSS" course</p>
                    <p class="text-sm text-gray-500">Nov 22, 2024</p>
                </div>
                <div class="bg-gray-700 p-4 rounded-lg shadow-md">
                    <p class="text-gray-300">You posted a new update in the "Web Design" group</p>
                    <p class="text-sm text-gray-500">Nov 21, 2024</p>
                </div>
                <div class="bg-gray-700 p-4 rounded-lg shadow-md">
                    <p class="text-gray-300">You updated your profile bio</p>
                    <p class="text-sm text-gray-500">Nov 20, 2024</p>
                </div>
            </div>
        </div>
    </div>


</div>

</body>
</html>
